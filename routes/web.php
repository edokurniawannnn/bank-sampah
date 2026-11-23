<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriSampahController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\SetoranController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Warga\DashboardController as WargaUserDashboardController;
use App\Http\Controllers\Warga\RiwayatController;
use App\Http\Controllers\Warga\RewardController as WargaRewardController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'warga'   => abort(403, 'Halaman Warga belum tersedia (Sprint C).'),
            'petugas' => redirect()->route('petugas.dashboard'),
            default   => abort(403, 'Role akun tidak valid atau tidak dikenali.'),
        };
    }

    return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori-sampah', KategoriSampahController::class)->except('show');
    Route::resource('mitra', MitraController::class)->except('show');
    Route::resource('reward', RewardController::class)->except('show');

    Route::prefix('warga')->name('warga.')->group(function () {
        Route::get('/', [WargaController::class, 'index'])->name('index');
        Route::get('/{warga}', [WargaController::class, 'show'])->name('show');
        Route::get('/{warga}/edit', [WargaController::class, 'edit'])->name('edit');
        Route::put('/{warga}', [WargaController::class, 'update'])->name('update');
        Route::patch('/{warga}/toggle-status', [WargaController::class, 'toggleStatus'])->name('toggle-status');
    });
});


Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::resource('setoran', SetoranController::class)->only(['index', 'create', 'store', 'show']);
    Route::patch('/setoran/{setoran}/verifikasi', [SetoranController::class, 'verifikasi'])->name('setoran.verifikasi');
});

Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaUserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/reward', [WargaRewardController::class, 'index'])->name('reward.index');
    Route::post('/reward/{reward}/tukar', [WargaRewardController::class, 'tukar'])->name('reward.tukar');
});
