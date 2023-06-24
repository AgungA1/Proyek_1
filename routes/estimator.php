<?php

use App\Http\Controllers\DashboardEstimatorController;
use App\Http\Controllers\DashboardStafController;
use App\Http\Controllers\EstimatorAuth\AuthenticatedSessionController;
use App\Http\Controllers\ReportEstimatorBarangKeluar;
use App\Http\Controllers\ReportEstimatorBarangMasuk;
use Illuminate\Support\Facades\Route;

Route::get('/estimator/dashboard', [DashboardEstimatorController::class, 'index'])->middleware(['auth:estimator', 'verified'])->name('estimator.dashboard');

Route::group(['prefix' => 'estimator', 'as' => 'estimator.'], function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
})->middleware('guest:estimator');

Route::group(['prefix' => 'estimator', 'as' => 'estimator.'], function(){
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/reportBarangMasuk', [ReportEstimatorBarangMasuk::class, 'index'])->middleware('auth:estimator', 'verified')->name('reportBarangMasuk');

    Route::get('/reportBarangKeluar', [ReportEstimatorBarangKeluar::class, 'index'])->middleware('auth:estimator', 'verified')->name('reportBarangKeluar');

    Route::get('/barangMasuk/cetak_pdf/{id}', [ReportEstimatorBarangMasuk::class, 'cetak'])->middleware('auth:estimator', 'verified')->name('cetakBarangMasuk');

    Route::get('/barangKeluar/cetak_pdf/{id}', [ReportEstimatorBarangKeluar::class, 'cetak'])->middleware('auth:estimator', 'verified')->name('cetakBarangKeluar');


})->middleware('auth:estimator');