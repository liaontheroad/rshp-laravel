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
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisDashboardController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Resepsionis\PetController;
use App\Http\Controllers\Resepsionis\ResepsionisPemilikController;
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

// API for dependent dropdown
Route::get('/api/get-ras/{idJenis}', [RasHewanController::class, 'getRasByJenis'])->name('api.get-ras');
});      

//akses Dokter
Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');

    // Patient Data Management
    Route::resource('pets', DokterPetController::class);

    // Medical Record Management
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::patch('/rekam-medis/{reservasi}/status', [RekamMedisController::class, 'updateStatus'])->name('rekam-medis.updateStatus');
    Route::get('/rekam-medis/create', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
    Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rekam-medis/history/{pet}', [RekamMedisController::class, 'history'])->name('rekam-medis.history');
});

//akses Perawat
Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');

    // Data Pasien
    Route::resource('pets', PetController::class)->only(['index', 'show']);

    // Rekam Medis CRUD
    Route::resource('rekam-medis', RekamMedisController::class);

    // Profil Perawat
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});
//akses Resepsionis
Route::middleware(['isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', [ResepsionisDashboardController::class, 'index'])->name('dashboard');
    Route::resource('temu-dokter', TemuDokterController::class);
    Route::resource('pets', PetController::class);
    Route::resource('pemilik', ResepsionisPemilikController::class);
});

//akses Pemilik
Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
    // Pets Routes (Read Only: Index & Show)
    Route::resource('pets', PeliharaanController::class)->only(['index', 'show']);
    // Temu Dokter Routes (Read Only: Index & Show)
    Route::resource('temu-dokter', TemuDokterController::class)->only(['index', 'show']);
    // Rekam Medis Routes (Read Only: Index & Show)
    Route::resource('rekam-medis', RekamMedisController::class)->only(['index', 'show']);
});

?>