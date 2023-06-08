<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PreferencesController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    error_log(auth()->user()->load("preferences"));
    return auth()->user()->load("preferences");
});

Route::group(['/'], function () {
    Route::get('/news/feed', [NewsController::class, 'feed']);
    Route::get('/news/sources', [NewsController::class, 'sources']);

    Route::post('/user/preferences', [PreferencesController::class, 'store']);
})->middleware(['auth:sanctum', 'throttle:6,1']);