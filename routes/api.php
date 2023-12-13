<?php

use App\Http\Controllers\ApiController;
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
Route::get('/api-endpoint', [ApiController::class, 'index']);
Route::get('/api-endpoint/{kenteken}', [ApiController::class, 'getByKenteken']);

Route::get('/carrosserie-gegevens', [ApiController::class, 'getAllCarrosserieGegevens']);
Route::get('/emissie-gegevens', [ApiController::class, 'getAllEmissieGegevens']);
