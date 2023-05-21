<?php

use App\Http\Controllers\JawabanTryoutController;
use App\Http\Controllers\SubKategoriSoalController;
use App\Http\Controllers\TryoutSoalController;
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
Route::get('/get-soal', [TryoutSoalController::class, 'getSoal']);

Route::delete('/delete-soal/{id_tryout_soal}', [TryoutSoalController::class, 'deleteSoal']);

Route::post('/tryout/add_soal', [TryoutSoalController::class, 'addSoal']);

Route::post('/save-tryout-answer/{tryout_id}', [JawabanTryoutController::class, 'saveAnswer']);
Route::post('/delete-tryout-answer/{tryout_id}', [JawabanTryoutController::class, 'deleteAnswer']);
Route::post('/flag-tryout-answer/{tryout_id}', [JawabanTryoutController::class, 'flagAnswer']);
Route::post('/delete-flag-tryout-answer/{tryout_id}', [JawabanTryoutController::class, 'deleteFlagAnswer']);
