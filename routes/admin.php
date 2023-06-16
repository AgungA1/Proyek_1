<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\RequestAdminController;
use App\HTTp\Controllers\DashboardController;
use App\Http\Controllers\ReportBarangKeluar;
use App\Http\Controllers\ReportBarangMasuk;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [DashboardController::class, 'getCount'])->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

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

Route::get('/admin/report', [ReportController::class, 'index'])->middleware('auth:admin', 'verified')->name('admin.report');

Route::get('/admin/reportBarangMasuk', [ReportBarangMasuk::class, 'index'])->middleware('auth:admin', 'verified')->name('admin.reportBarangMasuk');

Route::get('/admin/reportBarangKeluar', [ReportBarangKeluar::class, 'index'])->middleware('auth:admin', 'verified')->name('admin.reportBarangKeluar');