<?php

use App\Http\Controllers\RequestAdminController;
use App\Http\Controllers\DashboardStafController;
use App\Http\Controllers\ReportStafBarangMasuk;
use App\Http\Controllers\ReportStafBarangKeluar;
use App\Http\Controllers\ResponStafController;
use App\Http\Controllers\StafAuth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/staf/dashboard', [DashboardStafController::class, 'index'])->middleware(['auth:staf_gudang', 'verified'])->name('staf.dashboard');

Route::group(['prefix' => 'staf', 'as' => 'staf.'], function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
})->middleware('guest:staf_gudang');

Route::group(['prefix' => 'staf', 'as' => 'staf.'], function(){
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    
    Route::resource('response', ResponStafController::class);

    Route::get('upcoming-item-transfers', [RequestAdminController::class, 'staf_accepted_index'])
                ->name('upcoming');
  
    Route::get('/reportBarangMasuk', [ReportStafBarangMasuk::class, 'index'])->name('reportBarangMasuk');

    Route::get('/reportBarangKeluar', [ReportStafBarangKeluar::class, 'index'])->name('reportBarangKeluar');

    Route::get('/barangMasuk/cetak_pdf/{id}', [ReportStafBarangMasuk::class, 'cetak'])->name('cetakBarangMasuk');

    Route::get('/barangKeluar/cetak_pdf/{id}', [ReportStafBarangKeluar::class, 'cetak'])->name('cetakBarangKeluar');


})->middleware('auth:staf_gudang');