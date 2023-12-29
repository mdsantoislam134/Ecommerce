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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//core apis
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



// web php 
Route::post('/add-sub-catagory/{id}', [CatagoryController::class, 'add_sub_cata']);
Route::post('/add-catagory', [CatagoryController::class, 'add_cata']);
Route::get('/catagory-list', [CatagoryController::class, 'catalist']);
Route::post('/add-delivery-option', [DeliveryOptionController::class, 'add_delivery_option']);
Route::post('/add-policy', [PolicyController::class, 'add_policy']);



Route::post('/add-order', [OrderController::class, 'add_order']);
Route::post('/add-img', [TestController::class, 'addimg']);
Route::post('/add-multy-img', [TestController::class, 'addmultiimg']);


Route::middleware(['auth:sanctum'])->group(function () {

Route::post('/shop-details', [ShopDeteilsController::class, 'add_details']);
Route::post('/add-product', [ProductController::class, 'add_product']);
Route::post('/add-package', [ProductPackageController::class, 'add_package']);

// admin &&& user route 
Route::get('/logout', [WebUserController::class, 'logoutapi'])->name('logout');

 });
