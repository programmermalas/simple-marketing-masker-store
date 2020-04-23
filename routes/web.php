<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register'  => false,
    'reset'     => false
]);

Route::get('/', 'HomeController@index')->name('home');
Route::post('/product/{product}', 'HomeController@store')->name('store');
Route::get('/product/{product}/detail', 'HomeController@detail')->name('detail');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/update', 'CartController@update')->name('cart.update');
Route::get('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');

Route::get('/order/{order}', 'OrderController@index')->name('order');
Route::post('/order', 'OrderController@store')->name('order.store');
