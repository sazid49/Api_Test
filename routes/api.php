<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AdminController;

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

// Route::get('getPost/{id?}',[PostController::class,'index'])->name('api.posts');

// Route::post('addPost',[PostController::class,'addpost']);
// Route::put('updatePost/{id}',[PostController::class,'updatepost']);
// Route::delete('deletePost/{id}',[PostController::class,'deletepost']);
// Route::get('searchPost/{name}',[PostController::class,'searchpost']);
// Route::post('upload',[PostController::class,'fileUpload']);


Route::apiResource('post',AdminController::class);  
