<?php

use App\Http\Controllers\API\BarangAPIController;
use App\Http\Controllers\API\DetailAPIController;
use App\Http\Controllers\API\DivisiAPIController;
use App\Http\Controllers\API\JenisAPIController;
use App\Http\Controllers\API\JurusanAPIController;
use App\Http\Controllers\API\KategoriAPIController;
use App\Http\Controllers\API\KoleksiAPIController;
use App\Http\Controllers\API\KoleksiKeluarAPIController;
use App\Http\Controllers\API\LantaiAPIController;
use App\Http\Controllers\API\MerkAPIController;
use App\Http\Controllers\API\PeminjamanAPIController;
use App\Http\Controllers\API\RuangAPIController;
use App\Http\Controllers\API\SumberAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/floor', [LantaiAPIController::class, 'get_all'])->name('floor.get');
Route::get('/room', [RuangAPIController::class, 'get_all'])->name('room.get');
Route::get('/merk', [MerkAPIController::class, 'get_all'])->name('merk.get');
Route::get('/category', [KategoriAPIController::class, 'get_all'])->name('category.get');
Route::get('/division', [DivisiAPIController::class, 'get_all'])->name('division.get');
Route::get('/inventory_item', [BarangAPIController::class, 'get_all'])->name('inventory_item.get');
Route::get('/inventory_item_detail', [DetailAPIController::class, 'get_all'])->name('inventory_item_detail.get');
Route::get('/peminjaman', [PeminjamanAPIController::class, 'get_all'])->name('peminjaman.get');
Route::get('/jenis', [JenisAPIController::class, 'get_all'])->name('jenis.get');
Route::get('/sumber', [SumberAPIController::class, 'get_all'])->name('sumber.get');
Route::get('/jurusan', [JurusanAPIController::class, 'get_all'])->name('jurusan.get');
Route::get('/koleksi', [KoleksiAPIController::class, 'get_all'])->name('koleksi.get');
Route::get('/koleksi_print', [KoleksiAPIController::class, 'get_print'])->name('koleksi_print.get');
Route::get('/koleksi_keluar', [KoleksiAPIController::class, 'get_keluar'])->name('koleksi_keluar.get');
Route::get('/koleksi_kkn', [KoleksiAPIController::class, 'get_kkn'])->name('koleksi_kkn.get');
Route::get('/input_koleksi_keluar', [KoleksiKeluarAPIController::class, 'get_all'])->name('input_koleksi_keluar.get');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
