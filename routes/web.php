<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\KategoriSoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LatihanSoalController;
use App\Http\Controllers\MateriTextController;
use App\Http\Controllers\MateriVideoController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PaketSoalController;
use App\Http\Controllers\PaketTextController;
use App\Http\Controllers\PaketVideoController;
use App\Http\Controllers\Payment\TripayCallbackController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\SubKategoriSoalController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\TryoutSoalController;
use App\Http\Controllers\UserController;
use App\Models\Paket;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'paket' => Paket::all(),
//     ]);
// });

Route::get('/test', [GeneralController::class, 'test']);

Route::get('/convertlatex/{latex}', [GeneralController::class, 'convertLatex']);

Route::post('/callback', [TripayCallbackController::class, 'handle']);

Route::get('/', function () {
    return redirect()->to('register');
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

        Route::get('/paket/{id_paket}/pembayaran', [PembayaranController::class, 'index']);
        Route::post('/request_pembayaran', [TransaksiController::class, 'store']);
        Route::get('/pembayaran', [TransaksiController::class, 'pembayaran']);
        Route::get('/detail_transaksi/{reference}', [TransaksiController::class, 'detailTransaksi']);

        Route::get('/paket', [PaketController::class, 'member']);
        Route::get('/paket_aktif', [PaketController::class, 'aktif']);
        Route::get('/paket_aktif/{id_paket}', [PaketController::class, 'content']);
        Route::get('/paket_aktif/{id_paket}/video', [PaketController::class, 'contentVideo']);
        Route::get('/paket_aktif/{id_paket}/video/{id_paket_video}', [PaketController::class, 'videos']);

        Route::get('/paket_aktif/{id_paket}/text', [PaketController::class, 'contentText']);
        Route::get('/paket_aktif/{id_paket}/text/{id_paket_text}', [PaketController::class, 'texts']);

        Route::get('/paket_aktif/{id_paket}/tryout', [PaketController::class, 'contentTryout']);
        Route::get('/paket_aktif/{id_paket}/latihan', [PaketController::class, 'contentLatihan']);

        // GET REQUEST
        Route::get('/tryout', [TryoutController::class, 'member']);
        Route::get('/tryout/konfirmasi', [TryoutController::class, 'konfirmasi']);
        Route::get('/tryout/kerjakan/{segment_tryout_id}', [TryoutController::class, 'kerjakan']);
        Route::get('/tryout/review/{segment_tryout_id}', [TryoutController::class, 'review']);
        Route::get('/tryout/finish/{segment_tryout_id}', [TryoutController::class, 'finish']);
        Route::get('/tryout/history/{tryout_id}', [TryoutController::class, 'history']);

        // GET REQUEST
        Route::get('/latihan', [LatihanController::class, 'member']);
        Route::get('/latihan/konfirmasi', [LatihanController::class, 'konfirmasi'])->name('latihan.konfirmasi');
        Route::get('/latihan/kerjakan/{segment_latihan_id}', [LatihanController::class, 'kerjakan']);
        Route::get('/latihan/review/{segment_latihan_id}', [LatihanController::class, 'review']);
        Route::get('/latihan/finish/{segment_latihan_id}', [LatihanController::class, 'finish']);
        Route::get('/latihan/history/{latihan_id}', [LatihanController::class, 'history']);

        Route::get('/materi_video', [MateriVideoController::class, 'member']);
        Route::get('/materi_text', [MateriTextController::class, 'member']);
    });
});


// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::get('/detail_transaksi/{reference}', [TransaksiController::class, 'detailTransaksi']);
    Route::get('/aktifkan/{reference}', [TransaksiController::class, 'aktifkanTransaksi']);
    Route::get('/batalkan/{reference}', [TransaksiController::class, 'batalkanTransaksi']);
    Route::get('/pembayaran', [PembayaranController::class, 'listPembayaran'])->name('list_pembayaran');
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::put('/kelas', [KelasController::class, 'update']);
    Route::get('/kelas/edit/{id_kelas}', [KelasController::class, 'edit']);
    Route::delete('/kelas/{id_kelas}', [KelasController::class, 'delete'])->name('kelas.delete');

    Route::get('/paket', [PaketController::class, 'index'])->name('paket');
    Route::get('/paket/create', [PaketController::class, 'create']);
    Route::post('/paket', [PaketController::class, 'store']);
    Route::put('/paket', [PaketController::class, 'update']);
    Route::get('/paket/edit/{id_paket}', [PaketController::class, 'edit']);
    Route::put('/paket/tampilkan/{id_paket}', [PaketController::class, 'tampilkan']);
    Route::put('/paket/sembunyikan/{id_paket}', [PaketController::class, 'sembunyikan']);
    Route::delete('/paket/{id_paket}', [PaketController::class, 'delete'])->name('paket.delete');

    Route::get('/paket_soal', [PaketSoalController::class, 'index'])->name('paket_soal');
    Route::get('/paket_soal/create', [PaketSoalController::class, 'create']);
    Route::get('/paket_soal/{id_paket}', [PaketSoalController::class, 'soals']);
    Route::get('/paket_soal/{id_paket}/{kategori}', [PaketSoalController::class, 'soals']);
    Route::post('/paket_soal', [PaketSoalController::class, 'store']);
    Route::put('/paket_soal', [PaketSoalController::class, 'update']);
    Route::get('/paket_soal/edit/{id_paket}', [PaketSoalController::class, 'edit']);
    Route::delete('/paket_soal/{id_paket}', [PaketSoalController::class, 'delete'])->name('paket_soal.delete');


    Route::get('/paket_video', [PaketVideoController::class, 'index'])->name('paket_video');
    Route::get('/paket_video/create', [PaketVideoController::class, 'create']);
    Route::get('/paket_video/{id_paket}', [PaketVideoController::class, 'videos']);
    Route::post('/paket_video', [PaketVideoController::class, 'store']);
    Route::put('/paket_video', [PaketVideoController::class, 'update']);
    Route::get('/paket_video/edit/{id_paket}', [PaketVideoController::class, 'edit']);
    Route::delete('/paket_video/{id_paket}', [PaketVideoController::class, 'delete'])->name('paket_video.delete');

    Route::get('/paket_text', [PaketTextController::class, 'index'])->name('paket_text');
    Route::get('/paket_text/create', [PaketTextController::class, 'create']);
    Route::get('/paket_text/{id_paket}', [PaketTextController::class, 'texts']);
    Route::post('/paket_text', [PaketTextController::class, 'store']);
    Route::put('/paket_text', [PaketTextController::class, 'update']);
    Route::get('/paket_text/edit/{id_paket}', [PaketTextController::class, 'edit']);
    Route::delete('/paket_text/{id_paket}', [PaketTextController::class, 'delete'])->name('paket_text.delete');

    Route::get('/materi_video', [MateriVideoController::class, 'index'])->name('materi_video');
    Route::get('/materi_video/create', [MateriVideoController::class, 'create']);
    Route::post('/materi_video', [MateriVideoController::class, 'store']);
    Route::put('/materi_video', [MateriVideoController::class, 'update']);
    Route::get('/materi_video/edit/{id_materi_video}', [MateriVideoController::class, 'edit']);
    Route::delete('/materi_video/{id_materi_video}', [MateriVideoController::class, 'delete'])->name('materi_video.delete');

    Route::get('/materi_text', [MateriTextController::class, 'index'])->name('materi_text');
    Route::get('/materi_text/create', [MateriTextController::class, 'create']);
    Route::post('/materi_text', [MateriTextController::class, 'store']);
    Route::put('/materi_text', [MateriTextController::class, 'update']);
    Route::get('/materi_text/edit/{id_materi_text}', [MateriTextController::class, 'edit']);
    Route::delete('/materi_text/{id_materi_text}', [MateriTextController::class, 'delete'])->name('materi_text.delete');

    Route::get('/soal', [SoalController::class, 'index'])->name('soal');
    Route::get('/soal/tiu', [SoalController::class, 'tiu']);
    Route::get('/soal/create', [SoalController::class, 'create']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::put('/soal', [SoalController::class, 'update']);
    Route::get('/soal/edit/{id_soal}', [SoalController::class, 'edit']);
    Route::delete('/soal/{id_soal}', [SoalController::class, 'delete'])->name('soal.delete');
    Route::get('/download_format', [SoalController::class, 'downloadFormat']);

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

    Route::get('/latihan', [LatihanController::class, 'index'])->name('latihan');
    Route::get('/latihan/create', [LatihanController::class, 'create']);
    Route::post('/latihan', [LatihanController::class, 'store']);
    Route::put('/latihan', [LatihanController::class, 'update']);
    Route::get('/latihan/edit/{id_soal}', [LatihanController::class, 'edit']);
    Route::delete('/latihan/{id_soal}', [LatihanController::class, 'delete'])->name('latihan.delete');

    Route::get('/latihan_soal/{id_latihan}', [LatihanSoalController::class, 'index'])->name('latihan_soal');
    Route::get('/diskon', [DiskonController::class, 'index'])->name('diskon');
    Route::post('/diskon', [DiskonController::class, 'store'])->name('diskon');
    Route::put('/diskon', [DiskonController::class, 'update'])->name('diskon');


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
