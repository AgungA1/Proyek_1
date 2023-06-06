<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\RequestAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', function () {
    return view('admin.layouts.main');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
})->middleware('guest:admin');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
  
    Route::resource('request', RequestAdminController::class);
})->middleware('auth:admin');

Route::get('/admin/kelola-user', function() {
    return view('admin.kelola-user');
})->middleware('auth:admin');

Route::get('/admin/kategori', function() {
    return view('admin.kategori');
})->middleware('auth:admin');