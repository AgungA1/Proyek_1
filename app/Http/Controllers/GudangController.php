<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;


class GudangController extends Controller
{
    public function dataGudang(Request $request)
    {
        // $keyword = $request->input('search'); 
        
        // $query = Gudang::query();

        // if ($keyword) {
        //     $query->where(function ($query) use ($keyword) {
        //         $query->where('nama_gudang', 'like', "%$keyword%");
        //     });
        // }

        // $gudangs = $query->paginate(1);

        if($request->has('gudang')){
            $nama_gudang = request('gudang');
            $gudangs = Gudang::where('nama_gudang', 'LIKE', '%'.$nama_gudang.'%')->paginate(1);
            return view('admin.gudang', compact('gudangs'));
        } else{
            $gudangs = Gudang::orderby('id','asc')->paginate(4);
            return view('admin.gudang', compact('gudangs'));
        }

        
    }
    public function create(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'lokasi_gudang' => 'required|max:255',
        ]);

        $gudang = new Gudang();
        $gudang->nama_gudang = $request->input('nama_gudang');
        $gudang->lokasi_gudang = $request->input('lokasi_gudang');

        $gudang->save();

        return redirect()->route('admin.gudang')->with('success', 'Gudang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $gudang = Gudang::find($id);

        if (!$gudang) {
            return redirect()->route('admin.gudang')->with('error', 'Gudang tidak ditemukan');
        }

        $request->validate([
            'nama_gudang' => 'required',
            'lokasi_gudang' => 'required|max:255',
        ]);

        $gudang->nama_gudang = $request->input('nama_gudang');
        $gudang->lokasi_gudang = $request->input('lokasi_gudang');

        $gudang->save();

        return redirect()->route('admin.gudang')->with('success', 'Gudang berhasil ditambahkan');

    }

    public function delete($id)
    {
        $gudang = Gudang::find($id);

        if (!$gudang) {
            return redirect()->route('admin.gudang')->with('error', 'Gudang tidak ditemukan');
        }

        $gudang->delete();

        return redirect()->route('admin.gudang')->with('success', 'Gudang berhasil dihapus');

        
    }
}
