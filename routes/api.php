<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ShopCategory\ShopCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//just for testing
//Route::post('/register', [RegisteredUserController::class, 'store']);


Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('shop-categories', ShopCategoryController::class);
});
