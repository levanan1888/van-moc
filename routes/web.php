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