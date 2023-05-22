<?php

use App\Http\Controllers\EstimatorAuth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/estimator/dashboard', function () {
    return view('estimator.dashboard');
})->middleware(['auth:estimator', 'verified'])->name('estimator.dashboard');

Route::group(['prefix' => 'estimator', 'as' => 'estimator.'], function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
})->middleware('guest:estimator');

Route::group(['prefix' => 'estimator', 'as' => 'estimator.'], function(){
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
})->middleware('auth:estimator');