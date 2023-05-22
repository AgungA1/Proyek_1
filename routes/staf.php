<?php

use App\Http\Controllers\StafAuth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/staf/dashboard', function () {
    return view('staf.dashboard');
})->middleware(['auth:staf_gudang', 'verified'])->name('staf.dashboard');

Route::group(['prefix' => 'staf', 'as' => 'staf.'], function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
})->middleware('guest:staf_gudang');

Route::group(['prefix' => 'staf', 'as' => 'staf.'], function(){
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
})->middleware('auth:staf_gudang');