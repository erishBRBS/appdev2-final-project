<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ItemSizeController;
use App\Http\Controllers\ItemQuantityController;
use App\Http\Controllers\ItemBrandController;

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
//Log In & out
Route::post('/log-in', [AuthController::class, 'logIn']);


Route::middleware('auth:sanctum')->group(function () {

    //Admin
    Route::middleware('admin_middleware')->group(function(){
        //Users
        Route::get('/users', [InfoController::class, 'getAllUsers']);

        //Users with orders
        Route::get('/users-with-orders', [InfoController::class, 'getAllUsersWithOrders']);

        //Products
        Route::post('/product/create', [ProductController::class, 'createProduct']);
        Route::get('/product/read', [ProductController::class, 'readProducts']);
        Route::put('/product/update/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('/product/delete/{id}', [ProductController::class, 'deleteProduct']);

        //Product Brand
        Route::post('/create-brand', [ItemBrandController::class, 'createBrand']);
        Route::get('/view-brand', [ItemBrandController::class, 'viewAllBrands']);

        //Product Size
        Route::post('/create-size', [ItemSizeController::class, 'createSize']);
        Route::get('/view-size', [ItemSizeController::class, 'viewAllSize']);

        //Product Quantity
        Route::post('/create-qty', [ItemQuantityController::class, 'productQty']);
        Route::get('/view-qty', [ItemQuantityController::class, 'viewProductQty']);
        Route::put('/update-qty/{id}', [ItemQuantityController::class, 'updateQty']);
    });

    //User
    Route::middleware('user_middleware')->group(function(){
        Route::post('/order/create', [OrderController::class, 'createOrder']);
        Route::get('/order/view', [OrderController::class, 'viewOrders']);
    });

    Route::get('/log-out', [AuthController::class, 'logOut']);
});