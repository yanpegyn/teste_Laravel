<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\CategoriaController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/categoria', [CategoriaController::class, 'create']);
Route::middleware('auth:api')->get('/categoria/{id}', [CategoriaController::class, 'read']);
Route::middleware('auth:api')->get('/categoria', [CategoriaController::class, 'read']);
Route::middleware('auth:api')->put('/categoria/{id}', [CategoriaController::class, 'update']);
Route::middleware('auth:api')->delete('/categoria/{id}', [CategoriaController::class, 'delete']);
