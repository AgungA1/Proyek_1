<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\RequestAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstimatorController;
use App\Http\Controllers\StafGudangController;
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

    // route kelola user:admin
    Route::get('/kelola-user-staf', [StafGudangController::class, 'dataStaf'])->name('staf.kelola-user');
    Route::post('/create-staf', [StafGudangController::class, 'create'])->name('staf.create');
    Route::put('/update-staf/{id}', [StafGudangController::class, 'update'])->name('staf.update');
    Route::delete('/delete-staf/{id}', [StafGudangController::class, 'delete'])->name('staf.delete');
})->middleware('auth:admin');
