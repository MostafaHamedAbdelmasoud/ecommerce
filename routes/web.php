<?php

use Gloudemans\Shoppingcart\Facades\Cart;

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
Auth::routes();

Route::get('/','LandingPageController@index')->name('landing-page');
Route::get('/shop','ShopController@index')->name('shop.index');

Route::get('/shop/{product}','ShopController@show')->name('shop.show');
Route::get('/cart','CartController@index')->name('cart.index');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::post('/cart','CartController@store')->name('cart.store');

Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');


Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('SaveForLater.destroy');
// Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');


Route::get('empty',function(){

    // Cart::instance('saveForLater')->destroy();
    Cart::instance('saveForLater')->destroy();
});
