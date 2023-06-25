<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\RequestAdminController;
use App\Http\Controllers\RequestEstimatorController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
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
    
    Route::get('response', [RequestEstimatorController::class, 'response_index'])
                ->name('response');

    Route::get('upcoming-item-transfers', [RequestAdminController::class, 'admin_accepted_index'])
                ->name('upcoming');

    Route::get('note', [RequestEstimatorController::class, 'admin_accepted_index'])
                ->name('note');
})->middleware(['auth:admin', 'verified']);