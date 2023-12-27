<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopDeteilsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\ProductPackageController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\DeliveryOptionController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//core apis
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// web php route 


Route::post('/add-delivery-option', [DeliveryOptionController::class, 'add_delivery_option']);



Route::middleware(['auth:sanctum'])->group(function () {

Route::post('/shop-details', [ShopDeteilsController::class, 'add_details']);
Route::post('/add-product', [ProductController::class, 'add_product']);
Route::post('/add-package', [ProductPackageController::class, 'add_package']);

 });
