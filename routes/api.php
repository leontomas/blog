<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['guest']], function(){
	Route::post('/user/login', [AuthenticationController::class, 'login']);
	Route::post('/user/register', [AuthenticationController::class, 'create']);

});

// Route::group(['prefix' => 'user'], function(){
Route::group(['prefix' => 'author', 'middleware' => ['auth:author', 'author']], function(){

	Route::post('/logout', [AuthenticationController::class, 'logout']);

    Route::post('/read', [AuthenticationController::class, 'read']);//profile
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth:administrator', 'admin']], function(){

	Route::post('/logout', [AuthenticationController::class, 'logout']);

    Route::post('/read', [AuthenticationController::class, 'read']);//profile
    Route::post('/list', [UserController::class, 'list']);
    Route::post('/update', [UserController::class, 'update']);
    Route::post('/delete', [UserController::class, 'delete']);
	
    Route::group(['prefix'=>'blog'], function(){
	
		Route::post('/read', [BlogController::class, 'read']);
		Route::post('/list', [BlogController::class, 'list']);
		Route::post('/delete', [BlogController::class, 'delete']);
	});

});