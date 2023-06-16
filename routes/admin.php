<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\RequestAdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\SupplierController;
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

    Route::get('/kategori',[KategoriController::class, 'dataKategori'])->name('kategori');
    Route::post('/create-kategori', [KategoriController::class, 'create'])->name('create-kategori');
    Route::put('/update-kategori/{id}', [KategoriController::class, 'update'])->name('update-kategori');
    Route::delete('/delete-kategori/{id}', [KategoriController::class, 'delete'])->name('delete-kategori');
 
    // route gudang
    Route::get('/gudang',[GudangController::class, 'dataGudang'])->name('gudang');
    Route::post('/create-gudang', [GudangController::class, 'create'])->name('create-gudang');
    Route::put('/update-gudang/{id}', [GudangController::class, 'update'])->name('update-gudang');
    Route::delete('/delete-gudang/{id}', [GudangController::class, 'delete'])->name('delete-gudang');

    // route supplier
    Route::get('/supplier',[SupplierController::class, 'dataSupplier'])->name('supplier');
    Route::post('/create-supplier', [SupplierController::class, 'create'])->name('create-supplier');
    Route::put('/update-supplier/{id}', [SupplierController::class, 'update'])->name('update-supplier');
    Route::delete('/delete-supplier/{id}', [SupplierController::class, 'delete'])->name('delete-supplier');
})->middleware('auth:admin');
