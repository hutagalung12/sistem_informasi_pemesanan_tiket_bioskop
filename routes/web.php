<?php

use Illuminate\Support\Facades\Route;
use App\Models\Film;
use App\Models\Studio;
use App\Models\Jadwal;
use App\Models\Pemesanan;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KursiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
        Route::get('/pesan/{jadwal}', [PemesananController::class,'create'])
        ->name('pesan.create');

    Route::post('/pesan', [PemesananController::class,'store'])
        ->name('pesan.store');
        Route::delete('/pemesanans/{pemesanan}', [PemesananController::class, 'destroy'])
    ->name('pemesanans.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

       Route::get(
    '/dashboard',
    [DashboardController::class,'index']
)->name('admin.dashboard');

        Route::resource('films', FilmController::class);

        Route::resource('studios', StudioController::class);

        Route::resource('jadwals', JadwalController::class);

        Route::resource('kursis', KursiController::class);

        Route::resource('users', UserController::class);

        Route::get('/laporan', [PemesananController::class, 'laporan'])
            ->name('laporan');
            Route::get(
    '/laporan/pdf',
    [PemesananController::class, 'exportPdf']
)->name('laporan.pdf');
    });

/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pelanggan'])
    ->prefix('pelanggan')
    ->group(function () {

        Route::get(
            '/dashboard',
            [DashboardController::class,'pelanggan']
        )->name('pelanggan.dashboard');

        Route::get('/daftar-film', [FilmController::class, 'index'])
            ->name('daftar-film');

      Route::get('/jadwal-tayang', [DashboardController::class, 'jadwalTayang'])
    ->name('pelanggan.jadwal');

        Route::get('/pesan-tiket/{jadwal}', [PemesananController::class, 'create'])
            ->name('pesan.create');

        Route::post('/pesan-tiket', [PemesananController::class, 'store'])
            ->name('pesan.store');
            Route::get(
'/pembayaran/{pemesanan}',
[PemesananController::class,'pembayaran']
)->name('pembayaran');

Route::post(
'/bayar/{pemesanan}',
[PemesananController::class,'bayar']
)->name('bayar');

        Route::get('/riwayat', [PemesananController::class, 'index'])
            ->name('riwayat');
    });

/*
|--------------------------------------------------------------------------
| PDF TIKET
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/tiket/{id}/pdf', [PemesananController::class, 'pdf'])
        ->name('tiket.pdf');

});

/*
|--------------------------------------------------------------------------
| TEST ROLE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->get('/admin-test', function () {
        return 'HALAMAN ADMIN';
        
    });

Route::middleware(['auth', 'role:pelanggan'])
    ->get('/pelanggan-test', function () {
        return 'HALAMAN PELANGGAN';
    });