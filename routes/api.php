<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Registration
Route::post('/create-user', [AuthController::class, 'createUser']);
Route::post('/create-admin', [AuthController::class, 'createAdmin']);
//Log In & out
Route::post('/log-in', [AuthController::class, 'logIn']);


Route::middleware('auth:sanctum')->group(function () {

    //Admin
    Route::get('/users', [InfoController::class, 'getAllUsers']);
    Route::get('/users/{id}', [InfoController::class, 'getUserById']);
    Route::post('/product/create', [ProductController::class, 'createProduct']);
    Route::put('/product/update/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/product/delete/{id}', [ProductController::class, 'deleteProduct']);

    //User
    Route::post('/order/create', [OrderController::class, 'createOrder']);
    Route::get('/order/view', [OrderController::class, 'viewOrders']);

    Route::get('/log-out', [AuthController::class, 'logOut']);



});

    // //Admin
    // Route::middleware('admin_middleware')->group(function(){
    //     Route::get('/users', [InfoController::class, 'getAllUsers']);
    //     Route::get('/users/{id}', [InfoController::class, 'getUserById']);
    //     Route::post('/product/create', [ProductController::class, 'createProduct']);
    //     Route::put('/product/update/{id}', [ProductController::class, 'updateProduct']);
    //     Route::delete('/product/delete/{id}', [ProductController::class, 'deleteProduct']);
    // });