<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PenimbanganController;
use App\Models\Imunisasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class,'index']);

//Route input Data Create Read Update Delete @resource
Route::resource('/balita' ,BalitaController::class);
Route::resource('/imunisasi' ,ImunisasiController::class);
Route::resource('/orangtua' ,OrangTuaController::class);
Route::resource('/penimbangan' ,PenimbanganController::class);

//filter Penimbangan
Route::get('/filter/periodeTimbang',[PenimbanganController::class,'periodeTimbang']);

// cetak Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');

Route::resource('/blog' ,BlogController::class);
Route::resource('/akun' ,AkunController::class);
Route::get('/',[JadwalController::class,'index']);


Route::resource('/gallery', GalleryController::class);
