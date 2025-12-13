<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\siteController;

//Admin controllers
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\DokterController as AdminDokterController;
use App\Http\Controllers\Admin\PetController as AdminPetController;

//Dokter Controllers
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\PetController as DokterPetController;
use App\Http\Controllers\Dokter\RekamMedisController;
use App\Http\Controllers\Dokter\ProfileController;

use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Resepsionis\PendaftaranController;
use App\Http\Controllers\Pemilik\PeliharaanController;


Route::get('/check-connection', [siteController::class, 'checkConnection'])->name('site.check-connection');
Route::get('/', [siteController::class, 'index'])->name('site.home');
Route::get('home', [siteController::class, 'index'])->name('home');
Route::get('strukturorg', [siteController::class, 'strukturorg'])->name('strukturorg');
Route::get('layanan', [siteController::class, 'layanan'])->name('layanan');
Route::get('visimisi', [siteController::class, 'visimisi'])->name('visimisi');

// Authentication Routes - Defined Manually
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

//akses administrator 
Route::middleware(['isAdministrator'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    
// Master Data
Route::resource('jenis-hewan', JenisHewanController::class);
Route::resource('ras-hewan', RasHewanController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('kategori-klinis', KategoriKlinisController::class);
Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);

// User/Role Management
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);

// Data Management
Route::resource('pemilik', PemilikController::class);
Route::resource('dokter', AdminDokterController::class);
Route::resource('pets', AdminPetController::class);
});      

//akses Dokter
Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');

    // Patient Data Management
    Route::resource('pets', DokterPetController::class);

    // Medical Record Management
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::patch('/rekam-medis/{reservasi}/status', [RekamMedisController::class, 'updateStatus'])->name('rekam-medis.updateStatus');
    // Placeholder for future routes
    // Route::get('/rekam-medis/create', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
    // Route::get('/rekam-medis/history/{pet}', [RekamMedisController::class, 'history'])->name('rekam-medis.history');
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