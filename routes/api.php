<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest']], function(){
    Route::post('/user/login', [UserController::class, 'login']);
    Route::post('/user/register', [UserController::class, 'create']);

});

Route::group(['middleware' => ['admin']], function(){
    Route::post('/user/login', [UserController::class, 'login']);
    Route::post('/user/register', [UserController::class, 'create']);

});
