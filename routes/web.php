<?php
use Gloudemans\Shoppingcart\Facades\Cart;

// main page routes
Route::get('/', 'LandingPageController@index')->name('landing-page');

// products pages routes
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

// cart routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');
Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

// coupons routes
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

// checkout routes
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ShopController@search')->name('search');

Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');

Route::middleware('auth')->group(function(){
    Route::get('/my-profile','UsersController@edit')->name('users.edit')->middleware('auth');
    Route::patch('/my-profile', 'UsersController@update')->name('users.update');

    Route::get('/my-orders', 'OrdersController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'OrdersController@show')->name('orders.show');
});

Route::get('/blog/posts','PostsController@index')->name('blog.index');
