<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangGudang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Gudang;
use App\Models\RequestAdmin;
use App\Models\Kategori;
use App\Models\ResponStaf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RequestAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $search)
    {
        $kategoris = Kategori::all();
        $barangs = Barang::all();
        $requests = RequestAdmin::where('status_request', 'pending')
                                ->where(function ($query) use ($search) {
                                    if (($keyword = $search->keyword)) {
                                        $query->orWhere('jenis_request', 'LIKE', '%'.$keyword.'%')
                                                ->orWhere('status_persetujuan', 'LIKE', '%'.$keyword.'%')
                                                ->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                    }
                                })
                                ->with('gudang')
                                ->paginate(5);

        return view('admin.request.request', compact('requests', 'kategoris', 'barangs'));
    }

    public function admin_accepted_index(Request $search){
        $tanggal_sekarang = Carbon::now()->format('Y-m-d');
        $requests = RequestAdmin::where('status_request', 'accept')
                                ->where('tanggal', '>=', $tanggal_sekarang)
                                ->where(function ($query) use ($search) {
                                    if (($keyword = $search->keyword)) {
                                        $query->orWhere('jenis_request', 'LIKE', '%'.$keyword.'%')
                                                ->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                    }
                                })
                                ->with(['response' => function($query){
                                    $query->where('persetujuan_admin', 'accept')
                                            ->with('gudang');
                                }])
                                ->paginate(10); 

        return view('admin.upcoming', compact('requests'));
    }

    public function staf_accepted_index(Request $search){
        $tanggal_sekarang = Carbon::now()->format('Y-m-d');
        $requests = RequestAdmin::where('status_request', 'accept')
                                // ->where('tanggal', '>=', $tanggal_sekarang)
                                ->where(function ($query) use ($search) {
                                    if (($keyword = $search->keyword)) {
                                        $query->orWhere('jenis_request', 'LIKE', '%'.$keyword.'%')
                                                ->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                    }
                                })
                                ->with(['response' => function($query){
                                    $query->where('id_gudang', Auth::guard('staf_gudang')->user()->id_gudang)
                                            ->where('persetujuan_admin', 'accept');
                                }])
                                ->paginate(10);

        return view('staf.upcoming', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_admin = new RequestAdmin();

        $request->validate([
            'kuantitas' => 'required',
            'tanggal' => 'required',
        ]);
        
        if ($request->input('item_type') == 'new') {
            $request->validate([
                'kategori' => 'required',
                'nama_barang' => 'required',
            ]);
            $request_admin->id_kategori = $request->get('kategori');
            $request_admin->nama_barang = $request->get('nama_barang');
        }
        
        if ($request->input('item_type') == 'existing') {
            $request->validate([
                'barang' => 'required',
            ]);
            $request_admin->kode_barang = $request->get('barang');
            $barang = Barang::find($request->get('barang'));
            $request_admin->nama_barang = $barang->nama_barang;
        }
        
        $request_admin->kuantitas_barang = $request->get('kuantitas');
        $request_admin->tanggal = Carbon::createFromFormat('m/d/Y', $request->get('tanggal'))->format('Y-m-d');
        $request_admin->jenis_request = $request->input('request_type');
        $request_admin->status_request = 'pending';
        $request_admin->status_penyelesaian = 'pending';
        $request_admin->status_persetujuan = 'pending';

        $request_admin->save();

        return redirect()->route('admin.request.index')->with('positive', 'Request created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // mencari request admin yang diupdate dan memuat data barang yang akan diupdate
        $request_admin = RequestAdmin::find($id);
        $data_barang = new Request();

        // cek kondisi apabila request admin menggunakan data barang yang belum ada, maka akan dibuat dan id barang didaftarkan dalam
        // request admin
        if ($request_admin->kode_barang == null) {
            $barang = new Barang();
            $barang->id_kategori = $request_admin->id_kategori;
            $barang->nama_barang = $request_admin->nama_barang;
            $barang->save();
            $request_admin->kode_barang = $barang->id;
        }
        
        // mengecek jika admin ingin menghapus data request, maka data request beserta data setiap respon staf yang berkaitan
        // akan dihapus
        if ($request->input('persetujuan_admin') == 'delete') {
            ResponStaf::where('id_request', $id)
                        ->delete();
            RequestAdmin::find($id)
                        ->delete();
            return redirect()->route('admin.request.index')->with('delete', 'Request has been deleted.');;
        }

        // mengambil data respon staf yang berkaitan yang memiliki persetujuan partial dan accept
        $partial_responses = $request_admin->gudang()
                            ->wherePivot('persetujuan', 'partial')
                            ->orderBy('kuantitas', 'DESC')
                            ->get();
        $accept_response = $request_admin->gudang()
                            ->wherePivot('persetujuan', 'accept')
                            ->first();

        // melakukan validasi input beserta melakukan update pada kolom persetujuan_admin pada request admin
        $request->validate([
            'persetujuan_admin' => 'required',
        ]);
        $request_admin->status_request = $request->input('persetujuan_admin');
        $request_admin->save();

        // pada kondisi request diterima secara utuh oleh 1 gudang
        if ($request_admin->status_persetujuan == 'diterima') 
        {
            //update persrtujuan admin pada respon
            $accept_response->pivot->persetujuan_admin = $request->input('persetujuan_admin');
            $accept_response->pivot->save();

            // jika request dibatalkan, update data dihentikan dan user diredirect ke halaman request
            if ($request_admin->status_request == 'decline') {
                return redirect()->route('admin.request.index')->with('delete', 'Staf`s proposal has been declined.');
            }

            // menjalankan update data pada barang masuk/keluar dan pada tabel pivot barang_gudang
            $data_barang->replace([
                'id_gudang' => $accept_response->id,
                'kuantitas_barang' => $request_admin->kuantitas_barang,
                'kode_barang' => $request_admin->kode_barang,
                'tanggal' => $request_admin->tanggal,
                'jenis_request' => $request_admin->jenis_request,
            ]);
            
            $this->update_data($data_barang);

            return redirect()->route('admin.request.index')->with('positive', 'Staf`s proposal has been accepted.');
        } 
        // kondisi jika request diterima sebagian oleh 1 atau lebih gudang
        else if ($request_admin->status_persetujuan == 'diterima sebagian' ||  $request_admin->status_persetujuan == 'gabungan tidak utuh') 
        {
            foreach($partial_responses as $partial_response){
                $partial_response->pivot->persetujuan_admin = $request->input('persetujuan_admin');
                $partial_response->pivot->save();

                if ($request_admin->status_request == 'accept') {
                    $data_barang->replace([
                        'id_gudang' => $partial_response->id,
                        'kuantitas_barang' => $partial_response->pivot->kuantitas,
                        'kode_barang' => $request_admin->kode_barang,
                        'tanggal' => $request_admin->tanggal,
                        'jenis_request' => $request_admin->jenis_request,
                    ]);
                    $this->update_data($data_barang);
                }
            }

            // jika request dibatalkan, update data dihentikan dan user diredirect ke halaman request
            if ($request_admin->status_request == 'decline') {
                return redirect()->route('admin.request.index')->with('delete', 'Staf`s proposal has been declined.');
            }

            return redirect()->route('admin.request.index')->with('positive', 'Staf`s proposal has been accepted.');
        }
        //kondisi jika request diterima secara utuh dengan menggabungkan respon 2 atau lebih gudang
        else if ($request_admin->status_persetujuan == 'gabungan utuh') 
        {
            // melakukan penotalan kuantitas/ruang dari tiap gudang yang menyetujui sebagian request admin
            $total = 0;
            foreach($partial_responses as $partial_response){
                $total += $partial_response->pivot->kuantitas;
                $partial_response->pivot->persetujuan_admin = $request->input('persetujuan_admin');

                // jika total kuantitas/ruang melebihi request dari admin, maka data kuantitas dari respon gudang yang terakhir akan 
                // dikurangi sehingga memenuhi request admin tanpa kelebihan kuantitas/ruang
                if ($total > $request_admin->kuantitas_barang) {        
                    $partial_response->pivot->kuantitas = $partial_response->pivot->kuantitas + ($request_admin->kuantitas_barang - $total);
                    $partial_response->pivot->save();

                    if ($request_admin->status_request == 'accept') {
                        $data_barang->replace([
                            'id_gudang' => $partial_response->id,
                            'kuantitas_barang' => $partial_response->pivot->kuantitas,
                            'kode_barang' => $request_admin->kode_barang,
                            'tanggal' => $request_admin->tanggal,
                            'jenis_request' => $request_admin->jenis_request,
                        ]);
                        $this->update_data($data_barang);
                    }

                    break;
                }

                if ($total == $request_admin->kuantitas_barang) {        
                    $partial_response->pivot->save();

                    if ($request_admin->status_request == 'accept') {
                        $data_barang->replace([
                            'id_gudang' => $partial_response->id,
                            'kuantitas_barang' => $partial_response->pivot->kuantitas,
                            'kode_barang' => $request_admin->kode_barang,
                            'tanggal' => $request_admin->tanggal,
                            'jenis_request' => $request_admin->jenis_request,
                        ]);
                        $this->update_data($data_barang);
                    }
                    break;
                }

                $partial_response->pivot->save();

                if ($request_admin->status_request == 'accept') {
                    $data_barang->replace([
                        'id_gudang' => $partial_response->id,
                        'kuantitas_barang' => $partial_response->pivot->kuantitas,
                        'kode_barang' => $request_admin->kode_barang,
                        'tanggal' => $request_admin->tanggal,
                        'jenis_request' => $request_admin->jenis_request,
                    ]);
                    $this->update_data($data_barang);
                }
            }
            // jika request dibatalkan, update data dihentikan dan user diredirect ke halaman request
            if ($request_admin->status_request == 'decline') {
                return redirect()->route('admin.request.index')->with('delete', 'Staf`s proposal has been declined.');
            }
            
            return redirect()->route('admin.request.index')->with('positive', 'Staf`s proposal has been accepted.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_data(Request $data_barang){
        if ($data_barang->input('jenis_request') == 'Barang Masuk') 
        {
            $this->barang_masuk($data_barang);
        }
        if ($data_barang->input('jenis_request') == 'Barang Keluar') 
        {
            $this->barang_keluar($data_barang);
        }
    }

    public function barang_keluar(Request $request){
        $barang_keluar = new BarangKeluar();
        $barang_keluar->id_gudang = $request->input('id_gudang');
        $barang_keluar->kode_barang = $request->input('kode_barang');
        $barang_keluar->tanggal = $request->input('tanggal');
        $barang_keluar->kuantitas_barang = $request->input('kuantitas_barang');
        $barang_keluar->save();

        $barang = BarangGudang::where('id_gudang', $request->input('id_gudang'))
                                ->where('kode_barang',  $request->input('kode_barang'))
                                ->first();
        $barang->kuantitas_barang -= $request->input('kuantitas_barang');
        $barang->save();
    }

    public function barang_masuk(Request $request){
        $barang_masuk = new BarangMasuk();
        $barang_masuk->id_gudang = $request->input('id_gudang');
        $barang_masuk->kode_barang = $request->input('kode_barang');
        $barang_masuk->tanggal = $request->input('tanggal');
        $barang_masuk->kuantitas_barang = $request->input('kuantitas_barang');
        $barang_masuk->save();        

        $barang = BarangGudang::where('id_gudang', $request->input('id_gudang'))
                                ->where('kode_barang',  $request->input('kode_barang'))
                                ->count();

        if ($barang > 0) {
            $barang_gudang = BarangGudang::where('id_gudang', $request->input('id_gudang'))
                                ->where('kode_barang',  $request->input('kode_barang'))
                                ->first();
            $barang_gudang->kuantitas_barang += $request->input('kuantitas_barang');
            $barang_gudang->save();
        } else {
            $barang_gudang = new BarangGudang();
            $barang_gudang->id_gudang = $request->input('id_gudang');
            $barang_gudang->kode_barang = $request->input('kode_barang');
            $barang_gudang->kuantitas_barang = $request->input('kuantitas_barang');
            $barang_gudang->save();
        }
        
        // $a = $request->input('kuantitas_barang');
        // echo "<script>console.log('hehe : $a')</script>";
    }
}
