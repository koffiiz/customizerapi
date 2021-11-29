<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlobWaveformController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopifyWebhookController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. Thepse
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']] ,function () {
    Route::get('/content/{id}', [OrderController::class, 'show']);
});

Route::get('/login', function() {
    abort(403, 'Unauthorized.');
} )->name('login');

Route::apiResource('blobwaveform', BlobWaveformController::class);
Route::post('/waveform/order_create', [ShopifyWebhookController::class, 'createOrder']);
Route::delete('/blobwaveform/{id}', [BlobWaveformController::class, 'destroy']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
