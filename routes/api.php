<?php

use App\Http\Controllers\Api\GetRoverPicturesController;
use App\Http\Controllers\Api\TokenController;
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
Route::apiResource('tokens', TokenController::class);

Route::middleware(['auth:sanctum', 'abilities:read'])->group(function () {
    Route::get('nasa/rover-pictures', GetRoverPicturesController::class)->name('nasa.rover-pictures.index');
});
