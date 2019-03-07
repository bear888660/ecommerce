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

    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/', function(){
            return view('admin.index');
        })->name('admin.index');

        Route::resource('/product-categories', 'Admin\ProductCategoryController');
        Route::resource('/managers', 'Admin\ManagerController');
        Route::resource('/managements', 'Admin\ManagementController');
        Route::resource('/products', 'Admin\ProductController');

        Route::patch('/orders/{id}', 'Admin\OrderController@ship');
        Route::resource('/orders', 'Admin\OrderController');
        Route::get('/orders/{id}/tradeReview', 'Admin\OrderController@tradeReview')->name('order.trade-review');
    });

    Route::get('credit-card/MPG', 'fron\OrderCOntroller@payNotify');
    Route::post('credit-card/MPG', 'fron\OrderCOntroller@payNotify');
});

//前台
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout')->middleware('auth');
Route::get('/detail/{id}', 'Front\ProductController@showProduct');
Auth::routes();
//cart
Route::group(['middleware' => 'auth'], function(){
    Route::get('/cart', 'Front\CartController@index')->name('cart');
    Route::post('/cart', 'Front\CartController@store')->name('cart.store');
    Route::patch('/cart/{rowId}', 'Front\CartController@update')->name('cart.update');
    Route::delete('/cart/{rowId}', 'Front\CartController@destroy')->name('cart.destroy');
    Route::get('/cart/shipping', 'Front\CartController@setShipping')->name('cart.shipping');

    //order
    Route::get('/cart/{method}', 'Front\OrderController@create')->name('front.order.create');
    Route::post('/order/store', 'Front\OrderController@store')->name('front.order.store');

    //user center
    Route::get('/user-center', 'Front\OrderController@showOrders')->name('user.center');
    Route::get('/user-center/order-details', 'Front\OrderController@showOrderDetails');

    //金流
    Route::get('/cashflow/MPG/pay/{orderId}', 'Front\PaymentController@payByMPG')->name('MPG.pay');
    Route::post('/cashflow/MPG/complete', 'Front\PaymentController@MPGcomplete')->name('MPG.complete');
});
//金流
Route::post('/cashflow/MPG/notify', 'Front\PaymentController@MPGNotify')->name('MPG.notify');

//沒指定都轉到產品列表
Route::get('/categories/{product_categories}', 'Front\ProductController@showProductList');






