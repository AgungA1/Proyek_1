<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;


class GudangController extends Controller
{
    public function dataGudang(Request $request)
    {
        $gudangs = Gudang::orderby('id','asc')->paginate(5);
        return view('admin.gudang', compact('gudangs'));

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
