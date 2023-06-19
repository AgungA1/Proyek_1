<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function dataSupplier(Request $request)
    {
        $suppliers = supplier::orderby('id','asc')->paginate(5);
        return view('admin.supplier', compact('suppliers'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'no_telp_supplier' => 'required',
        ]);

        $supplier = new Supplier();
        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->alamat_supplier = $request->input('alamat_supplier');
        $supplier->no_telp_supplier = $request->input('no_telp_supplier');

        $supplier->save();

        return redirect()->route('admin.supplier')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return redirect()->route('admin.supplier')->with('error', 'Supplier tidak ditemukan');
        }

        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'no_telp_supplier' => 'required',
        ]);

        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->alamat_supplier = $request->input('alamat_supplier');
        $supplier->no_telp_supplier = $request->input('no_telp_supplier');

        $supplier->save();

        return redirect()->route('admin.supplier')->with('success', 'Supplier berhasil ditambahkan');

    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return redirect()->route('admin.supplier')->with('error', 'Supplier tidak ditemukan');
        }

        $supplier->delete();

        return redirect()->route('admin.supplier')->with('success', 'Supplier berhasil dihapus');
    }
}
