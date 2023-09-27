<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\izinabsenController;
use App\Http\Controllers\UnitkerjaController;
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
Route::middleware(['guest:pegawai'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class,'proseslogin']);
});

Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin',[AuthController::class,'prosesloginadmin']);
});

Route::middleware(['auth:pegawai'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/proseslogout',[AuthController::class,'proseslogout']);

    //Presensi
    Route::get('/presensi/create',[PresensiController::class,'create']);
    Route::post('/presensi/store',[PresensiController::class,'store']);

    //Edit Profile
    Route::get('/editprofile',[PresensiController::class,'editprofile']);
    Route::post('/presensi/{nik}/updateprofile',[PresensiController::class,'updateprofile']);

    //Histori
    Route::get('/presensi/histori',[PresensiController::class,'histori']);
    Route::post('/gethistori',[PresensiController::class,'gethistori']);
    
    //Izin
    Route::get('/presensi/izin',[PresensiController::class,'izin']);
    Route::get('/presensi/buatizin',[PresensiController::class,'buatizin']);
    Route::post('/presensi/storeizin',[PresensiController::class,'storeizin']);

    //Izin Absen
    Route::get('/izinabsen',[izinabsenController::class,'create']);
    
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin',[DashboardController::class,'dashboardadmin']);

    //Pegawai
    Route::get('/pegawai',[PegawaiController::class,'index']);
    Route::post('/pegawai/store',[PegawaiController::class,'store']);
    Route::post('/pegawai/edit',[PegawaiController::class,'edit']);
    Route::post('/pegawai/{nik}/update',[PegawaiController::class,'update']);
    Route::post('/pegawai/{nik}/delete',[PegawaiController::class,'delete']);

    //Unit Kerja
    Route::get('/unitkerja',[UnitkerjaController::class,'index']);
    Route::post('/unitkerja/store',[UnitkerjaController::class,'store']);
    Route::post('/unitkerja/edit',[UnitkerjaController::class,'edit']);
    Route::post('/unitkerja/{kode_uni}/update',[UnitkerjaController::class,'update']);
    Route::post('/unitkerja/{kode_uni}/delete',[UnitkerjaController::class,'delete']);

    //Presensi
    Route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
    Route::post('/getpresensi',[PresensiController::class,'getpresensi']);
    Route::post('/tampilkanpeta',[PresensiController::class,'tampilkanpeta']);
    Route::get('/presensi/laporan',[PresensiController::class,'laporan']);
    Route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);
});


