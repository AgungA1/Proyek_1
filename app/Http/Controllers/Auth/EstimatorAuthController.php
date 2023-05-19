<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimatorAuthController extends Controller
{
    public function __construct() {
        Auth::setDefaultDriver('estimator');
        config(['auth.defaults.passwords' => 'estimators']);
    }

    public function login(){
        return view('estimator_auth.estimatorlogin');
    }

    public function logoutEstimator(Request $request){
        Auth::guard('estimator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|min:5|max:30'
        ]);

        if (Auth::guard('estimator')->attempt(['email' => $request->identifier, 'password' => $request->password])||Auth::guard('estimator')->attempt(['username' => $request->identifier, 'password' => $request->password])) {
            // Authentication was successful...
            return redirect()->route('panel');
        } else {
            return redirect()->route('estimator.login')->with('fail','Incorrect credentials');
        }
    }
}
