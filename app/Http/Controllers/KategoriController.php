<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function dataKategori(Request $request)
    {
        $kategoris = Kategori::orderby('id','asc')->paginate(5);
        return view('admin.kategori', compact('kategoris'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi_kategori' => 'required|max:255',
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->deskripsi_kategori = $request->input('deskripsi_kategori');

        $kategori->save();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()->route('admin.kategori')->with('error', 'Kategori tidak ditemukan');
        }

        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi_kategori' => 'required|max:255',
        ]);

        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->deskripsi_kategori = $request->input('deskripsi_kategori');

        $kategori->save();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan');

    }

    public function delete($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()->route('admin.kategori')->with('error', 'Kategori tidak ditemukan');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
