<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index']);
Route::get('/home', [MainController::class, 'index']);
Route::get('/popularity', [MainController::class, 'popularity']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/category', [MainController::class, 'category']);
Route::get('/category/{category}', [MainController::class, 'category2']);
Route::get('/services', [MainController::class, 'serviceList']);
Route::get('/service/{service}', [ServiceController::class, 'show']);
Route::get('/sortby/price-high', [MainController::class, 'sortHighPrice'])->name('sort.highPrice');
Route::get('/sortby/price-low', [MainController::class, 'sortLowPrice'])->name('sort.lowPrice');
Route::get('/search/{search}', [MainController::class, 'search']);
Route::get('/testing', [MainController::class, 'testing']);
Route::get('/store/{seller}', [SellerController::class, 'show'])->name('seller.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::get('/history', [MainController::class, 'history'])->name('user.history');

    Route::get('/notification', [MainController::class, 'notification'])->name('user.notification');

    Route::get('/seller-registration', [SellerController::class, 'create'])->name('seller.registration');
    Route::post('/seller/create', [SellerController::class, 'store'])->name('seller.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/create/{id}', [OrderController::class, 'orderForm'])->name('order.form');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/completion/{order}', [SaleController::class, 'create'])->name('order.completion');
    Route::post('/order/add-review', [SaleController::class, 'store'])->name('order.addReview');
    Route::get('/orders/status/{status}', [OrderController::class, 'ordersFilter'])->name('order.filter');

    Route::post('/notif/mark-as-read', [MainController::class, 'notifRead'])->name('markNotification');
});

Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('/mystore', [SellerController::class, 'myStore'])->name('myStore.index');
    Route::get('/mystore/edit', [SellerController::class, 'edit'])->name('myStore.edit');
    Route::put('/mystore/update-info', [SellerController::class, 'update'])->name('myStore.update');
    Route::put('/mystore/update-photo', [SellerController::class, 'updateHeader'])->name('myStore.updateHeader');
    Route::get('/mystore/add-service', [ServiceController::class, 'create'])->name('myStore.addService');
    Route::post('/mystore/upload-service', [ServiceController::class, 'store'])->name('myStore.upload');
    Route::get('/mystore/orders', [SellerController::class, 'orders'])->name('myStore.orders');
    Route::get('/mystore/orders/{status}', [SellerController::class, 'ordersFilter'])->name('myStore.ordersFilter');
    Route::put('/mystore/order-status', [SellerController::class, 'orderStatus'])->name('myStore.orderStatus');
    Route::get('/mystore/edit-service/{service}', [ServiceController::class, 'edit'])->name('myStore.editService');
    Route::put('/mystore/update-service/{service}', [ServiceController::class, 'update'])->name('myStore.updateService');
    Route::delete('/mystore/delete-service', [ServiceController::class, 'destroy'])->name('myStore.deleteService');
    Route::get('/mystore/statistic', [SellerController::class, 'statistic'])->name('myStore.statistic');
});
