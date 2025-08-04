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

Route::get('/ao-vest', function () {
  return Redirect::to('/dong-phuc-vest-cong-so', 301);
});

Route::get('/ao-thun-cong-ty', function () {
  return Redirect::to('/ao-thun-dong-phuc-cong-ty', 301);
});

Route::get('/ao-thun-team-building', function () {
  return Redirect::to('/dong-phuc-team-building', 301);
});

// Van Moc Cart and Checkout Routes
Route::get('/cart', 'Theme\VanMoc\Http\Controllers\VanMocController@getCart')->name('public.cart');
Route::get('/checkout', 'Theme\VanMoc\Http\Controllers\VanMocController@getCheckout')->name('public.checkout');
Route::post('/checkout', 'Theme\VanMoc\Http\Controllers\VanMocController@postCheckout')->name('public.checkout.post');

// Custom Contact Form Route
Route::post('/send-custom-contact', 'App\Http\Controllers\CustomContactController@postSendContact')->name('public.send.custom.contact');