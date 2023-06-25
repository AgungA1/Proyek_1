<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\RequestEstimator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RequestEstimatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $search)
    {
        $barangs = Barang::all();
        $requests = RequestEstimator::where('status_request', 'pending')
                                        ->where(function ($query) use ($search) {
                                            if (($keyword = $search->keyword)) {
                                                $query->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                            }
                                        })
                                        ->paginate(5);
        $responded_requests = RequestEstimator::whereNot('status_request', 'pending')
                                        ->where(function ($query) use ($search) {
                                            if (($keyword = $search->keyword)) {
                                                $query->orWhere('status_request', 'LIKE', '%'.$keyword.'%')
                                                        ->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                            }
                                        })
                                        ->paginate(5);
        return view('estimator.request.request', compact('requests', 'barangs', 'responded_requests'));
    }

    public function admin_accepted_index(Request $search){
        $requests = RequestEstimator::where('status_request', 'accept')
                                        ->where(function ($query) use ($search) {
                                            if (($keyword = $search->keyword)) {
                                                $query->orWhere('nama_barang', 'LIKE', '%'.$keyword.'%');
                                            }
                                        })
                                        ->paginate(10);
        return view('admin.note', compact('requests'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function response_index()
    {
        $requests = RequestEstimator::where('status_request', 'pending')
                                        ->paginate(10);
        return view('admin.response', compact('requests'));
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
        $request_estimator = new RequestEstimator();

        $request->validate([
            'kuantitas' => 'required',
            'tanggal' => 'required',
        ]);

        if ($request->input('item_type') == 'new') {
            $request->validate([
                'nama_barang' => 'required',
            ]);
            $request_estimator->nama_barang = $request->get('nama_barang');
        }
        
        if ($request->input('item_type') == 'existing') {
            $request->validate([
                'barang' => 'required',
            ]);
            $request_estimator->nama_barang  = $request->get('barang');
        }

        $request_estimator->kuantitas_barang = $request->get('kuantitas');
        $request_estimator->tgl_pengadaan = Carbon::createFromFormat('m/d/Y', $request->get('tanggal'))->format('Y-m-d');
        $request_estimator->status_request = 'pending';

        $request_estimator->save();

        return redirect()->route('estimator.request.index')->with('positive', 'Request created successfully.');
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
        $request_estimator = RequestEstimator::find($id);
        $request_estimator->status_request = $request->input('persetujuan');
        $request_estimator->save();

        if ($request->input('persetujuan') == 'accept') {
            return redirect()->route('admin.response')->with('positive', 'Estimator`s request has been accepted.');
        } else {
            return redirect()->route('admin.response')->with('delete', 'Estimator`s request has been declined.');
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
        $request_estimator = RequestEstimator::find($id)->delete();
        return redirect()->route('admin.note')->with('delete', 'Note item has been deleted.');
    }
}
