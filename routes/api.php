<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;


// Authentication
Route::post('/register',
[AuthController::class,'register']);

Route::post('/login',
[AuthController::class,'login']);


// Protected Routes
Route::middleware('auth:sanctum')->group(function(){

    // Profile
    Route::get('/profile',
    [AuthController::class,'profile']);


    // Logout
    Route::post('/logout',
    [AuthController::class,'logout']);


    // Category CRUD
    Route::apiResource('categories',
    CategoryController::class);

    Route::apiResource('suppliers',
    SupplierController::class);

});