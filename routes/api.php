<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user',[AuthController::class,'user']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::apiResource('post',PostController::class);
});

Route::get('posts',[PostController::class,'allPosts']);
Route::get('posts/{id}',[PostController::class,'singlePosts']);

Route::get('/categories',[CategoryController::class,'categories']);
Route::get('/categories/{category}',[CategoryController::class,'categoryPosts']);
Route::get('/categories/search/{search}',[CategoryController::class,'searchPosts']);
