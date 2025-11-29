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
    //JENIS HEWAN
    Route::get('/jenis-hewan.index', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::get('/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    Route::post('/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('/jenis-hewan/{jenisHewan}/edit', [App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::put('/jenis-hewan/{jenisHewan}', [App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('jenis-hewan.update');
    Route::delete('/jenis-hewan/{jenisHewan}', [App\Http\Controllers\Admin\JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');
    Route::resource('jenis-hewan', App\Http\Controllers\Admin\JenisHewanController::class)
        ->except(['show'])
        ->parameters([
            'jenis-hewan' => 'jenisHewan'
        ]);
    //RAS HEWAN
    Route::get('/ras-hewan.index', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::get('/ras-hewan/create', [App\Http\Controllers\Admin\RasHewanController::class, 'create'])->name('ras-hewan.create');
    Route::post('/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'store'])->name('ras-hewan.store');
    Route::get('/ras-hewan/{rasHewan}/edit', [App\Http\Controllers\Admin\RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::put('/ras-hewan/{rasHewan}', [App\Http\Controllers\Admin\RasHewanController::class, 'update'])->name('ras-hewan.update');
    Route::delete('/ras-hewan/{rasHewan}', [App\Http\Controllers\Admin\RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');
    Route::resource('ras-hewan', App\Http\Controllers\Admin\RasHewanController::class)
        ->except(['show'])
        ->parameters([
            'ras-hewan' => 'rasHewan'
        ]);
        
    // KATEGORI HEWAN
    Route::get('/kategori.index', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}/edit', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori\}', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class)
        ->except(['show'])
        ->parameters([
            'kategori' => 'kategori'
    ]);

    // KATEGORI KLINIS
    Route::get('/kategori-klinis.index', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('kategori_klinis.index');
    Route::get('/kategori-klinis/create', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
    Route::post('/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::get('/kategori-klinis/{kategoriKlinis}/edit', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::put('/kategori-klinis/{kategoriKlinis}', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
    Route::resource('kategori-klinis', App\Http\Controllers\Admin\KategoriKlinisController::class)
        ->except(['show'])
        ->parameters([
            'kategori-klinis' => 'kategoriKlinis' 
    ]);

    // PEMILIK
    Route::get('/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('pemilik.index');
    Route::get('/pemilik/create', [App\Http\Controllers\Admin\PemilikController::class, 'create'])->name('pemilik.create');
    Route::post('/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'store'])->name('pemilik.store');
    Route::get('/pemilik/{pemilik}/edit', [App\Http\Controllers\Admin\PemilikController::class, 'edit'])->name('pemilik.edit');
    Route::put('/pemilik/{pemilik}', [App\Http\Controllers\Admin\PemilikController::class, 'update'])->name('pemilik.update');
    Route::resource('pemilik', App\Http\Controllers\Admin\PemilikController::class)
    ->except(['show'])
    ->parameters([
        'pemilik' => 'pemilik' 
    ]);

   // KODE TINDAKAN TERAPI
    Route::get('/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('kode_tindakan_terapi.index');
    Route::get('/kode-tindakan-terapi/create', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'create'])->name('kode-tindakan-terapi.create');
    Route::post('/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'store'])->name('kode-tindakan-terapi.store');
    Route::get('/kode-tindakan-terapi/{kodeTindakanTerapi}/edit', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'edit'])->name('kode-tindakan-terapi.edit');
    Route::put('/kode-tindakan-terapi/{kodeTindakanTerapi}', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'update'])->name('kode-tindakan-terapi.update');
    Route::resource('kode-tindakan-terapi', App\Http\Controllers\Admin\KodeTindakanTerapiController::class)
    ->except(['show'])
    ->parameters([
        'kode-tindakan-terapi' => 'kodeTindakanTerapi' 
    ]);

    // USER MANAGEMENT
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)
    ->except(['show'])
    ->parameters([
        'users' => 'user' 
    ]);

    // ROLE MANAGEMENT
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)
    ->except(['show'])
    ->parameters([
        'roles' => 'role' // Model binding name
    ]);

    // PETS (PASIEN)
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::resource('pets', App\Http\Controllers\Admin\PetController::class)
    ->except(['show'])
    ->parameters([
        'pets' => 'pet' // Model binding name
    ]);
});      

//akses Dokter
Route::middleware(['isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');

//patient management
    Route::get('/pets', [PetController::class, 'index'])->name('dokter.pets.index');
    Route::get('/pets/create',[App\Http\Controllers\Dokter\PetController::class,'create'])->name('pets.create');
    Route::post('/pets', [\Http\Controllers\Dokter\PetController::class,'store'])->name('pets.store');
    Route::get('/pets/{pet}/edit', [App\Http\Controllers\Dokter\PetController::class, 'edit'])->name('pets.edit');
    Route::put('/pets/{pet}', [App\Http\Controllers\Dokter\PetController::class, 'update'])->name('pets.update');
    Route::resource('roles', App\Http\Controllers\Dokter\PetController::class)
    ->except(['show'])
    ->parameters([
        'pets' => 'pet'
    ]);
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