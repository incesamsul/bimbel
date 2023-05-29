<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\KategoriSoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\SubKategoriSoalController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\TryoutSoalController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// GENERAL CONTROLLER ROUTE
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/bantuan', [GeneralController::class, 'index']);

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// MEMBER ROLE
Route::group(['middleware' => ['auth', 'ceklevel:member']], function () {


    Route::group(['prefix' => 'member'], function () {
        // GET REQUEST
        Route::get('/tryout', [TryoutController::class, 'member']);
        Route::get('/tryout/konfirmasi', [TryoutController::class, 'konfirmasi']);
        Route::get('/tryout/kerjakan/{segment_tryout_id}', [TryoutController::class, 'kerjakan']);
        Route::get('/tryout/review/{segment_tryout_id}', [TryoutController::class, 'review']);
        Route::get('/tryout/finish/{segment_tryout_id}', [TryoutController::class, 'finish']);
        Route::get('/tryout/history/{tryout_id}', [TryoutController::class, 'history']);
    });
});


// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::put('/kelas', [KelasController::class, 'update']);
    Route::get('/kelas/edit/{id_kelas}', [KelasController::class, 'edit']);
    Route::delete('/kelas/{id_kelas}', [KelasController::class, 'delete'])->name('kelas.delete');

    Route::get('/soal', [SoalController::class, 'index'])->name('soal');
    Route::get('/soal/create', [SoalController::class, 'create']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::put('/soal', [SoalController::class, 'update']);
    Route::get('/soal/edit/{id_soal}', [SoalController::class, 'edit']);
    Route::delete('/soal/{id_soal}', [SoalController::class, 'delete'])->name('soal.delete');

    Route::get('/kategori_soal', [KategoriSoalController::class, 'index'])->name('kategori_soal');
    Route::get('/kategori_soal/create', [KategoriSoalController::class, 'create']);
    Route::post('/kategori_soal', [KategoriSoalController::class, 'store']);
    Route::put('/kategori_soal', [KategoriSoalController::class, 'update']);
    Route::get('/kategori_soal/edit/{id_soal}', [KategoriSoalController::class, 'edit']);
    Route::delete('/kategori_soal/{id_soal}', [KategoriSoalController::class, 'delete'])->name('kategori_soal.delete');

    Route::get('/sub_kategori_soal', [SubKategoriSoalController::class, 'index'])->name('sub_kategori_soal');
    Route::get('/sub_kategori_soal/create', [SubKategoriSoalController::class, 'create']);
    Route::post('/sub_kategori_soal', [SubKategoriSoalController::class, 'store']);
    Route::put('/sub_kategori_soal', [SubKategoriSoalController::class, 'update']);
    Route::get('/sub_kategori_soal/edit/{id_soal}', [SubKategoriSoalController::class, 'edit']);
    Route::delete('/sub_kategori_soal/{id_soal}', [SubKategoriSoalController::class, 'delete'])->name('sub_kategori_soal.delete');

    Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout');
    Route::get('/tryout/create', [TryoutController::class, 'create']);
    Route::post('/tryout', [TryoutController::class, 'store']);
    Route::put('/tryout', [TryoutController::class, 'update']);
    Route::get('/tryout/edit/{id_soal}', [TryoutController::class, 'edit']);
    Route::delete('/tryout/{id_soal}', [TryoutController::class, 'delete'])->name('tryout.delete');

    Route::get('/tryout_soal/{id_tryout}', [TryoutSoalController::class, 'index'])->name('tryout_soal');


    Route::group(['prefix' => 'admin'], function () {
        // GET REQUEST
        Route::get('/pengguna', [UserController::class, 'pengguna']);

        // CRUD PENGGUNA
        Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
        Route::put('/pengguna', [UserController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{id}', [UserController::class, 'delete']);
    });
});





require __DIR__ . '/auth.php';
