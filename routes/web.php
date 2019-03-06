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
        // Route::resource('/orders', 'Admin\OrderController');
    });
});

//前台
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout')->middleware('auth');

Route::get('/detail/{id}', 'Front\ProductController@showProduct');

//cart
Route::get('/cart', 'Front\CartController@index')->name('cart.index');
Route::post('/cart', 'Front\CartController@store')->name('cart.store');
Route::patch('/cart/{rowId}', 'Front\CartController@update')->name('cart.update');
Route::delete('/cart/{rowId}', 'Front\CartController@destroy')->name('cart.destroy');
Route::get('/cart/complete', 'Front\CartController@complete')->name('cart.complete');
Route::get('/cart/shipping', 'Front\CartController@shipping')->name('cart.shipping');

//order
Route::get('/cart/{method}', 'Front\OrderController@create')->name('front.order.create');
Route::post('/cart/{method}', 'Front\OrderController@store')->name('front.order.store');
Route::get('/cart/cashflow/{method}', 'Front\OrderController@cashflow')->name('front.order.pay');




Route::get('/{product_categories}', 'Front\ProductController@showProductList');






