<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function __construct() {
        Auth::setDefaultDriver('admin');
        config(['auth.defaults.passwords' => 'admins']);
    }

    public function login(){
        return view('admin.testadmin');
    }

    public function logoutAdmin(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|min:5|max:30'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->identifier, 'password' => $request->password])||Auth::guard('admin')->attempt(['username' => $request->identifier, 'password' => $request->password])) {
            // Authentication was successful...
            return redirect()->route('panel');
        } else {
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
    }
}
