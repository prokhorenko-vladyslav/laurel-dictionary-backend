<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyDictionaryController;
use App\Http\Controllers\DailyWordController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\LearnedWordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function() {

    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');

    Route::middleware('auth:api')->group(function() {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    });
});

Route::middleware('auth:api')->group(function() {
    Route::get('user/current', [ UserController::class, 'current'])->name('user.current');

    Route::apiResource('user/setting', UserSettingController::class)->only('update');

    Route::apiResource('dictionary', DictionaryController::class)->only(['index']);
    Route::apiResource('dictionary/{dictionary}/word', WordController::class)->only(['index']);

    Route::apiResource('word/{word}/learned', LearnedWordController::class)->only(['store']);

    Route::get('quiz/next', [ \App\Http\Controllers\QuizController::class, 'next' ])->name('quiz.next');
    Route::post('quiz/check/{word}', [ \App\Http\Controllers\QuizController::class, 'check' ])->name('quiz.check');
});
