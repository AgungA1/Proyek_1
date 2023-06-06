<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gudang = Gudang::all();
        $posts = Gudang::orderBy()->paginate();
        return view('gudang.index', compact('gudang'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nama_gudang' => 'required',
            'lokasi_gudang' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        Gudang::Create($request-all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('gudang.index')->with('success', 'Gudang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan 
        $Gudang = Gudang::find($id);
        return view('gudang.edit', compact('Gudang')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Gudang = Gudang::find($id);
        return view('gudnag.edit', compact('Gudang'));
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
        $request->validate([
            'nama_gudang' => 'required',
            'lokasi_gudang' => 'required',
        ]);

        Gudang::find($id)->update($request->all());
        return redirect()->route('gudang.index')->with('success', 'Gudang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gudang::find($id)->delete();
        return redirect()->route('gudang.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
