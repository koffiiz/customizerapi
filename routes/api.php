<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlobWaveformController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopifyWebhookController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('blobwaveform', BlobWaveformController::class);
Route::post('/waveform/order_create', [ShopifyWebhookController::class, 'createOrder']);
Route::delete('/blobwaveform/{id}', [BlobWaveformController::class, 'destroy']);
