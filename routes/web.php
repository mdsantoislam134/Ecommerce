<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\DeliveryOptionController;
use App\Http\Controllers\PolicyController;



Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('billing', function () {
    return view('seller.billing');
})->name('billing');

Route::get('profile', function () {
    return view('seller.profile');
})->name('profile');

Route::get('rtl', function () {
    return view('seller.rtl');
})->name('rtl');

Route::get('user-management', function () {
    return view('laravel-examples/user-management');
})->name('user-management');

Route::get('tables', function () {
    return view('seller.tables');
})->name('tables');

Route::get('virtual-reality', function () {
    return view('seller.virtual-reality');
})->name('virtual-reality');

Route::get('static-sign-in', function () {
    return view('seller.static-sign-in');
})->name('sign-in');

Route::get('static-sign-up', function () {
    return view('seller.static-sign-up');
})->name('sign-up');

// Admin routes 

Route::middleware(['auth:sanctum'])->group(function () {

    
// CRUD Catagory

Route::post('/add-catagory', [CatagoryController::class, 'add_cata']);
Route::post('/add-sub-catagory/{id}', [CatagoryController::class, 'add_sub_cata']);
Route::get('/Catagory', [AdminController::class, 'showcata'])->name('catagory');
Route::get('/Sub-Catagory/{id}', [AdminController::class, 'showsubcata'])->name('subcatagory');
Route::get('/add-subcata/{id}', [AdminController::class, 'addsubcata'])->name('addsubcatagory');
Route::get('/add-catagory', [CatagoryController::class, 'addcata'])->name('addcatagory');

// policy && Delivery 

Route::get('/Add-Delivery-Option', [AdminController::class, 'adddeli']);
Route::get('/add-delivery-rulse', [AdminController::class, 'showForm']);
Route::post('/add-delivery-option', [DeliveryOptionController::class, 'add_delivery_option']);


Route::get('/add-Policy', [PolicyController::class, 'allpolicy']);
Route::get('/add-policy', [PolicyController::class, 'showForm']);
Route::post('/add-policy', [PolicyController::class, 'add_policy']);

    
     });
    
Route::get('/Admin', [AdminController::class, 'loginview']);
Route::post('/adminlogin', [AdminController::class, 'login'])->name('adminlogin');
Route::get('/Adminhome', [AdminController::class, 'home'])->name('Adminhome');


// Route::get('/Delete-Sub-Catagory/{id}', [AdminController::class, 'deletesubcata'])->name('deletesubcatagory');
// Route::get('/Delete-Catagory/{id}', [CatagoryController::class, 'deletecata']);



// admin &&& user route 
Route::get('/logout', [WebUserController::class, 'logout'])->name('logout');



// user routes 
Route::get('User/login', [WebUserController::class, 'loginview'])->name('userlogin');
Route::get('User/register', [WebUserController::class, 'registerview'])->name('userregister');

Route::post('/login', [WebUserController::class, 'login'])->name('login');


Route::get('/home', function () {
    return view('user.useregister');
});