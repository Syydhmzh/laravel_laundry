<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/', function(){
    $response = ['message' => 'API sudah berjalan'];
    return response()->json($response);
});

// harus login dulu buat dapet token
Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('user', [App\http\Controllers\API\ApiController::class, 'getUsers']);
    Route::get('me', [App\http\Controllers\API\ApiController::class, 'me']);
});
Route::get('user/{id}', [App\http\Controllers\API\ApiController::class, 'editUser']);
Route::post('user', [App\http\Controllers\API\ApiController::class, 'storeUser']);
Route::put('user/{id}', [App\http\Controllers\API\ApiController::class, 'updateUser']);
Route::delete('user/{id}', [App\http\Controllers\API\ApiController::class, 'deleteUser']);
Route::post('login', [App\http\Controllers\API\ApiController::class, 'loginAction']);

