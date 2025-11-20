<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Resepsionis\PendaftaranController;
use App\Http\Controllers\Pemilik\PeliharaanController;

Route::get('/check-connection', [siteController::class, 'checkConnection'])->name('site.check-connection');
Route::get('/', [siteController::class, 'index'])->name('site.home');
// Authentication Routes
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//akses administrator 
Route::middleware(['isAdministrator'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('home', [siteController::class, 'index'])->name('home');
    Route::get('strukturorg', [siteController::class, 'strukturorg'])->name('strukturorg');
    Route::get('layanan', [siteController::class, 'layanan'])->name('layanan');
    Route::get('visimisi', [siteController::class, 'visimisi'])->name('visimisi');
    //JENIS HEWAN
    Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');
    Route::get('/admin/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('admin.jenis-hewan.create');
    Route::post('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('admin.jenis-hewan.store');
    Route::get('/admin/jenis-hewan/{jenisHewan}/edit', [App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('admin.jenis-hewan.edit');
    Route::put('/admin/jenis-hewan/{jenisHewan}', [App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('admin.jenis-hewan.update');
    Route::delete('/admin/jenis-hewan/{jenisHewan}', [App\Http\Controllers\Admin\JenisHewanController::class, 'destroy'])->name('admin.jenis-hewan.destroy');


    Route::get('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.ras_hewan.index');
    Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');
    Route::get('/admin/kategori-hewan', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori_hewan.index');
    Route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategori_klinis.index');
    Route::get('/admin/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode_tindakan_terapi.index');
    Route::get('/admin/pets', [PetController::class, 'index'])->name('admin.pets.index');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

//akses Dokter
Route::middleware(['isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
});

//akses Perawat
Route::middleware(['isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
});

//akses Resepsionis
Route::middleware(['isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
    Route::get('/resepsionis/pendaftaran', [PendaftaranController::class, 'index'])->name('resepsionis.pendaftaran');
});

//akses Pemilik
Route::middleware(['isPemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard');
    Route::get('/pemilik/pets', [PeliharaanController::class, 'index'])->name('pemilik.pets.index');
});


?>
