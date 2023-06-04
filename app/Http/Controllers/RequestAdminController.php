<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\RequestAdmin;
use App\Models\Kategori;
use Illuminate\Http\Request;


class RequestAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        $barangs = Barang::all();
        $requests = RequestAdmin::where('status_request', 'pending')
                                ->paginate(10);
        return view('admin.request.request', compact('requests', 'kategoris', 'barangs'));
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
        }
        
        $request_admin->kuantitas_barang = $request->get('kuantitas');
        $request_admin->jenis_request = $request->input('request_type');
        $request_admin->status_request = 'pending';
        $request_admin->status_penyelesaian = 'pending';

        $request_admin->save();

        return redirect()->route('admin.request.index');
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
}
