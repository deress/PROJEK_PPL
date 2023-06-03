<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\CustomerKatalogController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\AdminSistemRegisterController;
use App\Http\Controllers\CustomerReservationController;
use App\Http\Controllers\DashboardadminController;
use App\Http\Controllers\DashboardadminProfileController;
use App\Http\Controllers\FeedbackController;




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

Route::get('/', [LandingController::class, 'index']);
Route::resource('/feedback', FeedbackController::class);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/dashboard/admin_sistem', function () {
    return view('dashboard_admin_sistem/index');
})->middleware('adminSistem');

Route::resource('/dashboard/admin_sistem/register', AdminSistemRegisterController::class)->middleware('adminSistem');

Route::group([
    'prefix'        => 'admin_cafe',
    'as'            => 'admin_cafe.',
    'middleware'    => ['adminCafe']
], function () {
    Route::resource('/dashboard', DashboardadminController::class);

    Route::resource('/profile', DashboardadminProfileController::class);

    Route::resource('/stok', StokController::class);

    Route::resource('/katalog', KatalogController::class);

    Route::resource('/reservation', ReservationController::class);
    Route::put('/reservation/cancel/{reservation}', [ReservationController::class, 'cancel']);


    Route::get('/keuangan/graph', [KeuanganController::class, 'graph']);
    Route::resource('/keuangan', KeuanganController::class);
});

Route::group([
    'prefix'        => 'customer',
    'as'            => 'cust.',
    'middleware'    => ['auth']
], function () {
    Route::resource('/home', CustomerHomeController::class);

    Route::resource('/katalog', CustomerKatalogController::class);

    Route::resource('/reservation', CustomerReservationController::class);
    Route::get('/reservation/payment/{reservation}', [CustomerReservationController::class, 'payment']);
    Route::put('/reservation/cancel/{reservation}', [CustomerReservationController::class, 'cancel']);
    Route::put('/reservation/paid/{reservation}', [CustomerReservationController::class, 'paid']);
    Route::put('/reservation/done/{reservation}', [CustomerReservationController::class, 'done']);

    Route::resource('/profile', CustomerProfileController::class);
});
