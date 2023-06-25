<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\RequestAdmin;
use App\Models\ResponStaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class ResponStafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $search)
    {
        $id_gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $requests = RequestAdmin::all();
        $responses = ResponStaf::where('id_gudang', $id_gudang)
                                ->whereIn('id_request', $requests->pluck('id')->toArray());
        $requests = RequestAdmin::whereNotIn('id', $responses->pluck('id_request')->toArray())
                                ->where(function ($query) use ($search) {
                                    if (($keyword = $search->keyword)) {
                                        $query->orWhere('jenis_request', 'LIKE', '%'.$keyword.'%')
                                                ->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                    }
                                })
                                ->paginate(10);
        $barangs = Barang::all();
        return view('staf.response', compact('requests', 'barangs'));
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
        $respon_staf = new ResponStaf();

        $request->validate([
            'id_gudang' => 'required',
            'id_request' => 'required',
            'persetujuan' => 'required',
        ]);

        if($request->persetujuan == 'partial'){
            $request->validate([
                'kuantitas' => 'required',
            ]);
            $respon_staf->kuantitas = $request->input('kuantitas');
        }

        $respon_staf->id_gudang = $request->input('id_gudang');
        $respon_staf->id_request = $request->input('id_request');
        $respon_staf->persetujuan = $request->input('persetujuan');
        $respon_staf->save();

        // pelabelan request sesuai dengan respon dari staf gudang
        $this->updateRequest($request, $respon_staf->id_request);

        if ($request->persetujuan == 'decline') {
            return redirect()->route('staf.response.index')->with('delete', 'Admin`s request has been declined.');
        } else {
            return redirect()->route('staf.response.index')->with('positive', 'Admin`s request has been accepted.');
        }
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
        //
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

    public function updateRequest(Request $request, $id){
        $request_admin = RequestAdmin::find($id);
        
        //$decline_responses = $request_admin->where($request_admin->gudang->pivot->persetujuan, 'decline')->count();
        $decline_responses = $request_admin->gudang()
                                            ->wherePivot('persetujuan', 'decline')
                                            ->count();
        $partial_responses = $request_admin->gudang()
                                            ->wherePivot('persetujuan', 'partial')
                                            ->orderBy('kuantitas', 'DESC')
                                            ->get();
        $gudangs = Gudang::all()->count(); 

        // pemberian status penolakan request, jika semua gudang menolak
        if ($gudangs == $decline_responses) {
            $request_admin->status_persetujuan = 'ditolak';
            $request_admin->save();
            return redirect()->route('staf.response.index');
        }

        // request belum dilabeli, 1 gudang menerima dengan tidak utuh
        if (($request->persetujuan == 'partial') && ($request_admin->status_persetujuan == 'pending')) {
            $request_admin->status_persetujuan = 'diterima sebagian';
            $request_admin->save();
            return redirect()->route('staf.response.index');
        }

        if (($request->persetujuan == 'partial') && ($request_admin->status_persetujuan == 'diterima sebagian')) {
            $total = 0;
            // hitung kuantitas atau ruang total yang dimiliki tiap gudang
            foreach ($partial_responses as $partial_response) {
                $total += $partial_response->pivot->kuantitas;
                // jika memenuhi, keluar dari foreach
                if ($total >= $request_admin->kuantitas_barang) {        
                    // jika memenuhi, dilabeli penerimaan gabungan utuh
                    $request_admin->status_persetujuan = 'gabungan utuh';
                    $request_admin->save();
                    return redirect()->route('staf.response.index');
                }
            }
            // jika tidak memenuhi, request dilabeli sebagai penerimaan gabungan yang tidak utuh
            if ($total < $request_admin->kuantitas_barang) {
                $request_admin->status_persetujuan = 'gabungan tidak utuh';
                $request_admin->save();
                return redirect()->route('staf.response.index');
            }
        }
        
        // request belum dilabeli, 1 gudang menerima dengan utuh
        if ($request->persetujuan == 'accept') {
            $request_admin->status_persetujuan = 'diterima';
            $request_admin->save();
            return redirect()->route('staf.response.index');
        }

        // gudang yang merespon request hanya gudang yang menolak, namun ada gudang yang belum memberi respon, 
        // tidak ada update label request
    }
}
