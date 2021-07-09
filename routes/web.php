<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PenimbanganController;
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
Route::resource('/orangtua' ,OrangTuaController::class);
Route::resource('/penimbangan' ,PenimbanganController::class);
Route::resource('/keuangan' ,KeuanganController::class);

//Route Bagian Keuangan
Route::get('/kasmasuk',[KeuanganController::class,'kasmasuk']);
Route::get('/kaskeluar',[KeuanganController::class,'kaskeluar']);
Route::get('/filter/periode',[KeuanganController::class,'periode']);
Route::get('/filter/periodeKasMasuk',[KeuanganController::class,'periodeKasMasuk']);
Route::get('/filter/periodeKasKeluar',[KeuanganController::class,'periodeKasKeluar']);
//Mencetak PDF Keuangan
Route::get('/filter/cetakpdfmasuk' ,[KeuanganController::class,'pdfMasuk']);
Route::get('/filter/cetakpdfkeluar' ,[KeuanganController::class,'pdfKeluar']);
Route::get('/filter/cetakpdfrekap' ,[KeuanganController::class,'pdfRekap']);
Route::get('/cetakrekap' ,[KeuanganController::class,'cetakRekap']);

Route::resource('/blog' ,BlogController::class);
Route::resource('/akun' ,AkunController::class);
Route::get('/',[JadwalController::class,'index']);


Route::resource('/gallery', GalleryController::class);


Route::get('/febyy', [KeuanganController::class,'cobabalita']);
