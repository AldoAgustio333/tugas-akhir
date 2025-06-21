<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JbiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\User\NotifikasiController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\TestimoniController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('profil', [UserController::class, 'profil'])->name('user.profil');
    Route::post('/profil/update', [UserController::class, 'updateProfil'])->name('user.updateProfil');
    Route::post('/profil/update-foto', [App\Http\Controllers\UserController::class, 'updateFoto'])->name('user.profile.update-foto');
    Route::post('/profil/update', [UserController::class, 'updateProfil'])->name('user.profile.update');


    Route::get('/jbi', [JbiController::class, 'index'])->name('user.jbi.index');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('user/jbi/{jbi}', [JbiController::class, 'show'])->name('user.jbi.show');
    Route::get('/user/jbi/order/{id}', [JbiController::class, 'order'])->name('user.jbi.order');
    Route::post('/user/jbi/order', [JbiController::class, 'storeOrder'])->name('user.jbi.storeOrder');
    
    // Routes untuk pembayaran
    Route::get('/pembayaran/{id}/step1', [JbiController::class, 'step1'])->name('pembayaran.pembayaran_step1');
    Route::post('/pembayaran/{id}/step2', [JbiController::class, 'step2'])->name('pembayaran.pembayaran_step2');
    Route::post('/pembayaran/{id}/konfirmasi', [JbiController::class, 'konfirmasi'])->name('pembayaran.pembayaran_konfirmasi');
    Route::post('/pembayaran/kirim/{id}', [JbiController::class, 'uploadBukti'])->name('pembayaran.uploadBukti');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('riwayat.show');
    Route::get('/riwayat/{id}/invoice', [RiwayatController::class, 'invoice'])->name('riwayat.invoice');

    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');

    // Routes untuk notifikasi
    Route::get('/user/notifikasi', [NotifikasiController::class, 'index'])->name('user.notifikasi');

    
   

});

// Route khusus untuk ketua (admin)
Route::middleware(['auth', 'role:ketua_uld'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
    Route::put('/pemesanan/{id}/terima', [PemesananController::class, 'terima'])->name('pemesanan.terima');



});
