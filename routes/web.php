<?php

use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ScanController;
use App\Livewire\RegisterGuardian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect('/admin/login'); // Atau arahkan ke halaman login yang benar
})->name('login');
Route::middleware(['auth'])->group(function () {

    Route::get('/guardian/dashboard', [GuardianController::class, 'dashboard'])->name('guardian.dashboard');
    Route::get('/guardian/history', [GuardianController::class, 'history'])->name('guardian.history');
});


Route::get('/scan', [ScanController::class, 'showScanPage'])->name('scan.page');
Route::get('/scan/validate-qr', [ScanController::class, 'validateQr'])->name('scan.validateQr');
Route::get('/scan/konfirmasi/{qr_code}', [ScanController::class, 'showConfirmationPage'])->name('scan.showConfirmation');
Route::post('/scan/submit-konfirmasi', [ScanController::class, 'submitConfirmation'])->name('scan.submitConfirmation');
