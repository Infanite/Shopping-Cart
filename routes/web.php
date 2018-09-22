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

Route::get('/',[

  'uses'=> 'ProductController@getIndex',
  'as'=> 'product.index'

]);

Route::get('/add-to-card/{id}', [

  'uses' => 'ProductController@getAddToCart',
  'as' => 'product.addToCart'

]);

Route::get('/shopping-cart', [

  'uses' => 'ProductController@getCart',
  'as' => 'product.shoppingCart'

]);

Route::get('/reduce/{id}', [

  'uses' => 'ProductController@getReducedByOne',
  'as' => 'product.reduceByOne'

]);

Route::get('/remove/{id}', [

  'uses' => 'ProductController@getRemoveItem',
  'as' => 'product.remove'

]);

Route::get('/checkout',[

  'uses'=> 'ProductController@getCheckout',
  'as'=> 'checkout',
  'middleware' => 'auth'

]);

Route::post('/checkout',[

  'uses'=> 'ProductController@postCheckout',
  'as'=> 'checkout',
  'middleware' => 'auth'

]);

Route::get('/user/signup',[

  'uses'=> 'UserController@getSignup',
  'as'=> 'user.signup',
  'middleware' => 'guest'

]);

Route::post('/user/signup',[

  'uses'=> 'UserController@postSignup',
  'as'=>'user.signup',
  'middleware' => 'guest'

]);

Route::get('/user/login',[

  'uses' => 'UserController@getLogin',
  'as' => 'user.login',
  'middleware' => 'guest'

]);

Route::post('/user/login',[

  'uses' => 'UserController@postLogin',
  'as' => 'user.login',
  'middleware' => 'guest'

]);

Route::get('/user/profile/', [

  'uses' => 'UserController@getProfile',
  'as' => 'user.profile',
  'middleware' => 'auth'

]);

Route::get('/user/logout', [

  'uses' => 'UserController@getLogout',
  'as' => 'user.logout',
  'middleware' => 'auth'

]);
