<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function dataSupplier(Request $request)
    {
        // $keyword = $request->input('search');
        
        // $query = Supplier::query();

        // if ($keyword) {
        //     $query->where(function ($query) use ($keyword) {
        //         $query->where('nama_supplier', 'like', "%$keyword%");
        //     });
        // }

        // $suppliers = $query->paginate(5);
        if($request->has('supplier')){
            $nama_supplier = request('supplier');
            $suppliers = Supplier::where('nama_supplier', 'LIKE', '%'.$nama_supplier.'%')->paginate(1);
            return view('admin.supplier', compact('suppliers'));
        } else{
            $suppliers = supplier::orderby('id','asc')->paginate(2);
            return view('admin.supplier', compact('suppliers'));
        }

        // return view('admin.supplier', compact('suppliers', 'keyword'));
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
