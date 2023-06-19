<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\StafGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StafGudangController extends Controller
{
    public function dataStaf(Request $request)
    {
        $gudangs = Gudang::all();
        $stafs = StafGudang::orderby('id','asc')->paginate(5);
        return view('admin.kelola-user.staf', compact('stafs','gudangs'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|min:6',
            'id_gudang' => 'required',
        ]);

        $staf = new StafGudang();
        $gudangs = new Gudang();
        $staf->username = $request->input('username');
        $staf->nama = $request->input('nama');
        $staf->email = $request->input('email');
        $staf->no_telp = $request->input('no_telp');
        $staf->id_gudang = $request->input('id_gudang');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $staf->avatar = $avatar;
        }

        $staf->password = Hash::make($request->input('password'));

        $staf->save();

        return redirect()->route('admin.staf.kelola-user')->with('success', 'StafGudang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $staf = StafGudang::find($id);

        if (!$staf) {
            return redirect()->route('admin.staf.kelola-user')->with('error', 'StafGudang tidak ditemukan');
        }

        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'id_gudang' => 'required',
        ]);

        $staf->username = $request->input('username');
        $staf->nama = $request->input('nama');
        $staf->email = $request->input('email');
        $staf->no_telp = $request->input('no_telp');
        $staf->id_gudang = $request->input('id_gudang');

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($staf->avatar && file_exists(storage_path('app/public/' . $staf->avatar))) {
                Storage::delete('public/' . $staf->avatar);
            }

            $avatar = $request->file('avatar')->store('avatars', 'public');
            $staf->avatar = $avatar;
        }

        if (!empty($request->input('password'))) {
            $request->validate([
                'password' => 'required|min:6',
            ]);
            $staf->password = Hash::make($request->input('password'));
        }

        $staf->save();

        return redirect()->route('admin.staf.kelola-user')->with('success', 'StafGudang berhasil diperbarui');

    }

    public function delete($id)
    {
        $staf = StafGudang::find($id);

        if (!$staf) {
            return redirect()->route('admin.staf.kelola-user')->with('error', 'StafGudang tidak ditemukan');
        }

        $staf->delete();

        return redirect()->route('admin.staf.kelola-user')->with('success', 'StafGudang berhasil dihapus');
    }
}
