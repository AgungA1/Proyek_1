<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StafGudangAuthController extends Controller
{
    public function __construct() {
        Auth::setDefaultDriver('staf_gudang');
        config(['auth.defaults.passwords' => 'staf_gudangs']);
    }

    public function login(){
        return view('staf_gudang_auth.staf_gudanglogin');
    }

    public function logoutStafGudang(Request $request){
        Auth::guard('staf_gudang')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|min:5|max:30'
        ]);

        if (Auth::guard('staf_gudang')->attempt(['email' => $request->identifier, 'password' => $request->password])||Auth::guard('staf_gudang')->attempt(['username' => $request->identifier, 'password' => $request->password])) {
            // Authentication was successful...
            return redirect()->route('panel');
        } else {
            return redirect()->route('staf_gudang.login')->with('fail','Incorrect credentials');
        }
    }
}
