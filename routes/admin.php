<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JbiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\PemesananController;
use App\Models\User;
use App\Models\Jbi;
use App\Models\Pemesanan;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});

Route::middleware(['auth', 'role:admin,ketua_uld'])->group(function () {
    Route::get('/dashboard', function () {
        $jumlahUser = User::count();
        $jumlahJbi = Jbi::count();
        $jumlahPemesanan = Pemesanan::count();
        $pesananTerbaru = Pemesanan::latest()->take(5)->get();
        return view('admin.dashboard', compact('jumlahUser','jumlahJbi','jumlahPemesanan','pesananTerbaru'));
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('users/{id}', [UserController::class, 'updateUser'])->name('users.update');

    Route::get('/jbi', [JbiController::class, 'index'])->name('jbi.index');
    Route::get('/jbi/create', [JbiController::class, 'create'])->name('admin.jbi.create');
    Route::post('/jbi/store', [JbiController::class, 'store'])->name('jbi.store');
    Route::get('jbi/{jbi}', [JbiController::class, 'show'])->name('jbi.show');
    Route::delete('jbi/{jbi}', [JbiController::class, 'destroy'])->name('jbi.destroy');
    Route::put('/jbi/{id}', [JbiController::class, 'updateJBI'])->name('jbi.update');

    // Report
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/export-pdf', [ReportController::class, 'exportPdf'])->name('report.exportPdf');
    Route::get('/report/exportPdfJbi', [ReportController::class, 'exportPdfJbi'])->name('report.exportPdfJbi');

    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
    Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
    Route::put('/admin/pemesanan/{id}/terima', [PemesananController::class, 'terima'])->name('admin.pemesanan.terima');

    Route::get('/admin/laporan/pemesanan', [ReportController::class, 'pemesanan'])->name('laporan.pemesanan');



    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});


    




?>