<?php

use App\Http\Controllers\JawabanLatihanController;
use App\Http\Controllers\JawabanTryoutController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LatihanSoalController;
use App\Http\Controllers\MateriTextController;
use App\Http\Controllers\MateriVideoController;
use App\Http\Controllers\PaketTextController;
use App\Http\Controllers\PaketTextRelasiController;
use App\Http\Controllers\PaketVideoController;
use App\Http\Controllers\PaketVideoRelasiController;
use App\Http\Controllers\SegmentLatihanController;
use App\Http\Controllers\SegmentTryoutController;
use App\Http\Controllers\SubKategoriSoalController;
use App\Http\Controllers\TryoutSoalController;
use App\Models\PaketVideoRelasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/get_sub_kategori_soal/{id_kategori_soal}', [SubKategoriSoalController::class, 'getByKategoriSoal']);

Route::get('/search_soal', [TryoutSoalController::class, 'searchSoal']);

Route::get('/get-soal/{id_tryout}/{segment_tryout_id}', [TryoutSoalController::class, 'getSoal']);
Route::get('/get-soal-latihan/{id_latihan}/{segment_latihan_id}', [LatihanSoalController::class, 'getSoal']);

Route::get('/get-videos', [MateriVideoController::class, 'getVideos']);
Route::get('/get-paket-video-name/{id_paket_video}', [PaketVideoController::class, 'getPaketVideoName']);

Route::get('/get-video-paket/{id_paket}', [PaketVideoRelasiController::class, 'getVideoPaket']);


Route::post('/paket-video/add-video', [PaketVideoRelasiController::class, 'addVideo']);
Route::delete('/paket-video/delete-video/{id_video}', [PaketVideoRelasiController::class, 'deleteVideo']);

Route::get('/get-texts', [MateriTextController::class, 'getTexts']);
Route::get('/get-paket-text-name/{id_paket_text}', [PaketTextController::class, 'getPaketTextName']);

Route::get('/get-text-paket/{id_paket}', [PaketTextRelasiController::class, 'getTextPaket']);


Route::post('/paket-text/add-text', [PaketTextRelasiController::class, 'addText']);
Route::delete('/paket-text/delete-text/{id_text}', [PaketTextRelasiController::class, 'deleteText']);



Route::delete('/delete-soal/{id_tryout_soal}', [TryoutSoalController::class, 'deleteSoal']);

Route::post('/tryout/add_soal', [TryoutSoalController::class, 'addSoal']);
Route::post('/latihan/add_soal', [LatihanSoalController::class, 'addSoal']);

Route::post('/save-tryout-answer/{segment_tryout_id}', [JawabanTryoutController::class, 'saveAnswer']);
Route::post('/delete-tryout-answer/{segment_tryout_id}', [JawabanTryoutController::class, 'deleteAnswer']);
Route::post('/flag-tryout-answer/{tryout_id}', [JawabanTryoutController::class, 'flagAnswer']);
Route::post('/delete-flag-tryout-answer/{tryout_id}', [JawabanTryoutController::class, 'deleteFlagAnswer']);

Route::post('/save-latihan-answer/{segment_latihan_id}', [JawabanLatihanController::class, 'saveAnswer']);
Route::post('/delete-latihan-answer/{segment_latihan_id}', [JawabanLatihanController::class, 'deleteAnswer']);
Route::post('/flag-latihan-answer/{latihan_id}', [JawabanLatihanController::class, 'flagAnswer']);
Route::post('/delete-flag-latihan-answer/{latihan_id}', [JawabanLatihanController::class, 'deleteFlagAnswer']);


Route::post('/make_segment/{tryout_id}', [SegmentTryoutController::class, 'makeSegment']);
Route::post('/start_segment/{tryout_id}', [SegmentTryoutController::class, 'startSegment']);
Route::post('/finish_segment/{segment_tryout_id}', [SegmentTryoutController::class, 'finishSegment']);


Route::post('/make_segment_latihan/{latihan_id}', [SegmentLatihanController::class, 'makeSegment']);
Route::post('/start_segment_latihan/{latihan_id}', [SegmentLatihanController::class, 'startSegment']);
Route::post('/finish_segment_latihan/{segment_latihan_id}', [SegmentLatihanController::class, 'finishSegment']);
