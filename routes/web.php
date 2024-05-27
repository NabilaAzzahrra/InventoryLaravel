<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BkeluarController;
use App\Http\Controllers\BmasukController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\ScanqrController;
use App\Http\Controllers\ScanScontroller;
use App\Http\Controllers\TransaksiController;
use Faker\Extension\BarcodeExtension;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('lantai', LantaiController::class)->middleware(['auth']);
Route::resource('ruang', RuangController::class)->middleware(['auth']);
Route::resource('merk', MerkController::class)->middleware(['auth']);
Route::resource('kategori', KategoriController::class)->middleware(['auth']);
Route::resource('divisi', DivisiController::class)->middleware(['auth']);
Route::resource('barang', BarangController::class)->middleware(['auth']);
Route::resource('bmasuk', BmasukController::class)->middleware(['auth']);
Route::resource('bkeluar', BkeluarController::class)->middleware(['auth']);
Route::resource('print', PrintController::class)->middleware(['auth']);
Route::resource('peminjaman', PeminjamanController::class)->middleware(['auth']);
Route::resource('dashboard', dashboardController::class)->middleware(['auth']);

Route::get('/scan', [ScanScontroller::class, 'index'])->name('scan.index')->middleware(['auth']);
Route::get('/scanQr/{id}/show', [ScanqrController::class, 'show'])->name('scanqr.edit');
Route::post('/scanQr', [ScanqrController::class, 'store'])->name('scanqr.store');
Route::get('/scanQr', [ScanqrController::class, 'index'])->name('scanqr.index');
Route::get('/scanQr', [ScanqrController::class, 'update'])->name('scanqr.update');
Route::post('/scanQr/{id}', [ScanqrController::class, 'update'])->name('scanqr.update');


require __DIR__.'/auth.php';
