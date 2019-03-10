<?php

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

//後台
Route::group(['prefix' => 'admin'], function() {

    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.show');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/', 'Admin\HomeController@index')->name('admin.index');
        Route::get('/users', 'Admin\UserController@index')->name('user.index');
        Route::resource('/product-categories', 'Admin\ProductCategoryController');
        Route::resource('/managers', 'Admin\ManagerController');
        Route::resource('/managements', 'Admin\ManagementController');
        Route::resource('/products', 'Admin\ProductController');
        Route::patch('/orders/{id}', 'Admin\OrderController@ship');
        Route::resource('/orders', 'Admin\OrderController');
        Route::get('/orders/{id}/tradeReview', 'Admin\OrderController@tradeReview')->name('order.trade-review');
    });
});

//前台
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

//產品
Route::get('/categories/{product_categories}', 'ProductController@showProductList');
Route::get('/products/{productId}', 'ProductController@show')->name('product.show');

Route::post('/cart', 'CartController@add')->name('cart.store');
Route::get('/cart/count-items', 'CartController@countItems')->name('cart.count-item');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::patch('/cart/{rowId}', 'CartController@update')->name('cart.update');
    Route::delete('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');
    Route::get('/cart/shipping', 'CartController@setShipping')->name('cart.shipping');
    

    //order
    Route::get('/cart/{method}', 'OrderController@create')->name('front.order.create');
    Route::post('/order/store', 'OrderController@store')->name('front.order.store');

    //user center
    Route::get('/user-center', 'OrderController@showOrders')->name('user.center');
    Route::get('/user-center/order-details', 'OrderController@showOrderDetails');

    //金流
    Route::get('/payment/{orderId}/MPGpay', 'PaymentController@payByMPG')->name('payment.MPGpay');
    Route::post('/payment/MPG/complete', 'PaymentController@MPGcomplete')->name('payment.MPG.complete');
});

//金流
Route::post('/payment/MPG/notify', 'PaymentController@MPGNotify')->name('payment.MPG.notify');








