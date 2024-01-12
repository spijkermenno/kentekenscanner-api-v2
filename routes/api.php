<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AnalyticsController;

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

Route::post('/gekentekende-voertuigen/{gekentekendeVoertuigenId}/upload-image', [ImageController::class, 'store']);
Route::get('/gekentekende-voertuigen/{gekentekendeVoertuigenId}/images', [ImageController::class, 'index']);

Route::get('/carrosserie-gegevens', [ApiController::class, 'getAllCarrosserieGegevens']);
Route::get('/emissie-gegevens', [ApiController::class, 'getAllEmissieGegevens']);


Route::middleware('admin')->group(function () {
    Route::get('/unvalidated-images', [ImageController::class, 'showUnvalidatedImages']);
    
    Route::get('/unvalidated-images-json', [ImageController::class, 'getUnvalidatedImages']);
    Route::get('/validated-images-json', [ImageController::class, 'getValidatedImages']);
    
    Route::get('/unvalidated-images-count', [ImageController::class, 'getUnvalidatedImagesCount']);
    Route::get('/validated-images-count', [ImageController::class, 'getValidatedImagesCount']);
    Route::get('/images-count', [ImageController::class, 'getImagesCount']);
    
    Route::get('/images', [ImageController::class, 'getAllImages']);

    Route::post('/validate-image/{imageId}', [ImageController::class, 'validateImage']);
    Route::delete('/delete-image/{imageId}', [ImageController::class, 'deleteImage']);

    Route::post('/track-event', [AnalyticsController::class, 'trackEvent']);

    Route::prefix('analytics')->group(function () {
        Route::get('events/by-type', [AnalyticsController::class, 'getEventsByType']);
        Route::get('events/by-date', [AnalyticsController::class, 'getEventsByDate']);
        Route::get('events/for-graph', [AnalyticsController::class, 'getEventsForGraph']);
    });
});
