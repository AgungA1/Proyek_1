<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\RequestAdminController;
use App\HTTp\Controllers\DashboardController;
use App\Http\Controllers\ReportBarangKeluar;
use App\Http\Controllers\ReportBarangMasuk;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstimatorController;
use App\Http\Controllers\StafGudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [DashboardController::class, 'getCount'])->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
})->middleware('guest:admin');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::resource('request', RequestAdminController::class);

    // route kelola user:admin
    Route::get('/kelola-user', [AdminController::class, 'dataAdmin'])->name('kelola-user');
    Route::post('/create-admin', [AdminController::class, 'create'])->name('create');
    Route::put('/update-admin/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete-admin/{id}', [AdminController::class, 'delete'])->name('delete');

    // route kelola user:estimator
    Route::get('/kelola-user-estimator', [EstimatorController::class, 'dataEstimator'])->name('estimator.kelola-user');
    Route::post('/create-estimator', [EstimatorController::class, 'create'])->name('estimator.create');
    Route::put('/update-estimator/{id}', [EstimatorController::class, 'update'])->name('estimator.update');
    Route::delete('/delete-estimator/{id}', [EstimatorController::class, 'delete'])->name('estimator.delete');

    //route Report
    Route::get('/report', [ReportController::class, 'index'])->middleware('auth:admin', 'verified')->name('report');

    Route::get('/reportBarangMasuk', [ReportBarangMasuk::class, 'index'])->middleware('auth:admin', 'verified')->name('reportBarangMasuk');

    Route::get('/reportBarangKeluar', [ReportBarangKeluar::class, 'index'])->middleware('auth:admin', 'verified')->name('reportBarangKeluar');

    Route::get('/baranggudang/cetak_pdf/{id}', [ReportController::class, 'cetak'])->name('cetakReport');

    Route::get('/barangkeluar/cetak_pdf/{id}', [ReportBarangKeluar::class, 'cetak'])->name('cetakBarangKeluarReport');

    Route::get('/barangmasuk/cetak_pdf/{id}', [ReportBarangMasuk::class, 'cetak'])->name('cetakBarangMasukReport');



    // route kelola user:admin
    Route::get('/kelola-user-staf', [StafGudangController::class, 'dataStaf'])->name('staf.kelola-user');
    Route::post('/create-staf', [StafGudangController::class, 'create'])->name('staf.create');
    Route::put('/update-staf/{id}', [StafGudangController::class, 'update'])->name('staf.update');
    Route::delete('/delete-staf/{id}', [StafGudangController::class, 'delete'])->name('staf.delete');

    Route::get('/kategori', [KategoriController::class, 'dataKategori'])->name('kategori');
    Route::post('/create-kategori', [KategoriController::class, 'create'])->name('create-kategori');
    Route::put('/update-kategori/{id}', [KategoriController::class, 'update'])->name('update-kategori');
    Route::delete('/delete-kategori/{id}', [KategoriController::class, 'delete'])->name('delete-kategori');

    // route gudang
    Route::get('/gudang', [GudangController::class, 'dataGudang'])->name('gudang');
    Route::post('/create-gudang', [GudangController::class, 'create'])->name('create-gudang');
    Route::put('/update-gudang/{id}', [GudangController::class, 'update'])->name('update-gudang');
    Route::delete('/delete-gudang/{id}', [GudangController::class, 'delete'])->name('delete-gudang');

    // route supplier
    Route::get('/supplier', [SupplierController::class, 'dataSupplier'])->name('supplier');
    Route::post('/create-supplier', [SupplierController::class, 'create'])->name('create-supplier');
    Route::put('/update-supplier/{id}', [SupplierController::class, 'update'])->name('update-supplier');
    Route::delete('/delete-supplier/{id}', [SupplierController::class, 'delete'])->name('delete-supplier');
})->middleware('auth:admin');
