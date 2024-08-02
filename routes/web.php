<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AyahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisImunController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');

//Route input Data Create Read Update Delete @resource
Route::resource('/balita' ,BalitaController::class)->middleware('auth');
Route::resource('/imunisasi' ,ImunisasiController::class)->middleware('auth');
Route::resource('/orangtua' ,OrangTuaController::class)->middleware('auth');
Route::resource('/ayah' ,AyahController::class)->middleware('auth');
Route::resource('/kelahiran' ,KelahiranController::class)->middleware('auth');
Route::resource('/penimbangan' ,PenimbanganController::class)->middleware('auth');

//filter Penimbangan
Route::get('/filter/periodeTimbang',[PenimbanganController::class,'periodeTimbang'])->middleware(['auth', 'admin']);

// cetak Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index')->middleware(['auth', 'admin']);
Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf')->middleware(['auth', 'admin']);

Route::resource('/blog' ,BlogController::class)->middleware(['auth', 'admin']);
Route::resource('/jenisimun' ,JenisImunController::class)->middleware(['auth', 'admin']);
Route::resource('/akun' ,AkunController::class)->middleware(['auth', 'admin']);
// Route::resource('/profile', ProfileController::class);
Route::get('/',[JadwalController::class,'index']);

// Menampilkan form profil
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');

// Mengupdate profil
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


Route::resource('/gallery', GalleryController::class)->middleware(['auth', 'admin']);
