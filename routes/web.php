<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardadminProfileController;
use App\Http\Controllers\AdminSistemRegisterController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\CustomerKatalogController;
use App\Http\Controllers\CustomerProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/dashboard/admin_sistem', function () {
    return view('dashboard_admin_sistem/index');
})->middleware('adminSistem');

Route::resource('/dashboard/admin_sistem/register', AdminSistemRegisterController::class)->middleware('adminSistem');


Route::get('/dashboard/admin_cafe', function () {
    return view('dashboard_admin_cafe/index');
})->middleware('adminCafe');

Route::resource('/dashboard/admin_cafe/profile', DashboardadminProfileController::class)->middleware('adminCafe');

Route::resource('/dashboard/admin_cafe/stok', StokController::class)->middleware('adminCafe');

Route::resource('/dashboard/admin_cafe/katalog', KatalogController::class)->middleware('adminCafe');

Route::group([
    'prefix'        => 'customer',
    'as'            => 'cust.',
    'middleware'    => ['auth']
], function () {
    Route::resource('/home', CustomerHomeController::class);

    Route::resource('/katalog', CustomerKatalogController::class);
    Route::get('/katalog/payment/{katalog}', [CustomerKatalogController::class, 'payment']);


    Route::resource('/profile', CustomerProfileController::class);
});
