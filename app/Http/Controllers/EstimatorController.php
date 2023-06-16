<?php

namespace App\Http\Controllers;

use App\Models\Estimator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class EstimatorController extends Controller
{
    public function dataEstimator(Request $request)
    {
        if($request->has('search')){
            $keyword = request('search');
            $estimators = Estimator::where('username', 'LIKE', '%'.$keyword.'%')
            ->orWhere('nama', 'LIKE', '%'.$keyword.'%')
            ->orWhere('email', 'LIKE', '%'.$keyword.'%')
            ->paginate(5);
            return view('admin.kelola-user.estimator', compact('estimators'));
        } else{
            $estimators = Estimator::orderby('id','asc')->paginate(5);
            return view('admin.kelola-user.estimator', compact('estimators'));
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

        $estimator = new Estimator();
        $estimator->username = $request->input('username');
        $estimator->nama = $request->input('nama');
        $estimator->email = $request->input('email');
        $estimator->no_telp = $request->input('no_telp');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $estimator->avatar = $avatar;
        }

        $estimator->password = Hash::make($request->input('password'));

        $estimator->save();

        return redirect()->route('admin.estimator.kelola-user')->with('success', 'Estimator berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $estimator = Estimator::find($id);

        if (!$estimator) {
            return redirect()->route('admin.estimator.kelola-user')->with('error', 'Estimator tidak ditemukan');
        }

        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
        ]);

        $estimator->nama = $request->input('nama');
        $estimator->username = $request->input('username');
        $estimator->email = $request->input('email');
        $estimator->no_telp = $request->input('no_telp');

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($estimator->avatar && file_exists(storage_path('app/public/' . $estimator->avatar))) {
                Storage::delete('public/' . $estimator->avatar);
            }

            $avatar = $request->file('avatar')->store('avatars', 'public');
            $estimator->avatar = $avatar;
        }

        if (!empty($request->input('password'))) {
            $request->validate([
                'password' => 'required|min:6',
            ]);
            $estimator->password = Hash::make($request->input('password'));
        }

        $estimator->save();

        return redirect()->route('admin.estimator.kelola-user')->with('success', 'Estimator berhasil diperbarui');

    }

    public function delete($id)
    {
        $estimator = Estimator::find($id);

        if (!$estimator) {
            return redirect()->route('admin.estimator.kelola-user')->with('error', 'Estimator tidak ditemukan');
        }

        $estimator->delete();

        return redirect()->route('admin.estimator.kelola-user')->with('success', 'Estimator berhasil dihapus');
    }
}
