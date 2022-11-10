<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['guest']], function(){
	Route::post('/user/login', [UserController::class, 'login']);
	Route::post('/user/register', [UserController::class, 'create']);

});

// Route::group(['prefix' => 'user'], function(){
Route::group(['prefix' => 'user', 'middleware' => ['auth:user', 'user']], function(){

	Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/read', [UserController::class, 'read']);
    Route::post('/list', [UserController::class, 'list']);
    Route::post('/update', [UserController::class, 'update']);
    Route::post('/delete', [UserController::class, 'delete']);
	
    Route::group(['prefix'=>'blog'], function(){
	
        Route::post('/create', [BlogController::class, 'create']);
		Route::post('/read', [BlogController::class, 'read']);
		Route::post('/list', [BlogController::class, 'list']);
		Route::post('/update', [BlogController::class, 'update']);
		Route::post('/delete', [BlogController::class, 'delete']);
	});

});