<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dataAdmin(Request $request)
    {
        if($request->has('search')){
            $keyword = request('search');
            $admins = Admin::where('username', 'LIKE', '%'.$keyword.'%')
            ->orWhere('nama', 'LIKE', '%'.$keyword.'%')
            ->orWhere('email', 'LIKE', '%'.$keyword.'%')
            ->paginate(5);
            return view('admin.kelola-user.admin', compact('admins'));
        } else{
            $admins = Admin::orderby('id','asc')->paginate(5);
            return view('admin.kelola-user.admin', compact('admins'));
        }

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
        ]);

        $admin = new Admin();
        $admin->username = $request->input('username');
        $admin->nama = $request->input('nama');
        $admin->email = $request->input('email');
        $admin->no_telp = $request->input('no_telp');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $admin->avatar = $avatar;
        }

        $admin->password = Hash::make($request->input('password'));

        $admin->save();

        return redirect()->route('admin.kelola-user')->with('success', 'Admin berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);


        if (!$admin) {
            return redirect()->route('admin.kelola-user')->with('error', 'Admin tidak ditemukan');
        }

        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
        ]);

        $admin->nama = $request->input('nama');
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');
        $admin->no_telp = $request->input('no_telp');

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($admin->avatar && file_exists(storage_path('app/public/' . $admin->avatar))) {
                Storage::delete('public/' . $admin->avatar);
            }

            $avatar = $request->file('avatar')->store('avatars', 'public');
            $admin->avatar = $avatar;
        }

        if (!empty($request->input('password'))) {
            $request->validate([
                'password' => 'required|min:6',
            ]);
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return redirect()->route('admin.kelola-user')->with('success', 'Admin berhasil diperbarui');

    }

    public function delete($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->route('admin.kelola-user')->with('error', 'Admin tidak ditemukan');
        }

        $admin->delete();

        return redirect()->route('admin.kelola-user')->with('success', 'Admin berhasil dihapus');
    }
}
