<?php

use App\Http\Controllers\Api\AdvertController;
use App\Http\Controllers\Api\SchemaController;
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

Route::get('schema', [SchemaController::class, 'getSchema']);

Route::apiResource('/adverts', AdvertController::class)->only([
    'index', 'show', 'store',
]);
