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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/store', 'Store@index');
Route::get('/store/index/{id?}', 'Store@index');
Route::get('/store/cart/{id}', 'Store@cartItemInsert');
Route::get('/store/cartremoveitem/{id}', 'Store@cartItemRemove');
Route::get('/store/cartremove', 'Store@cartRemove');
Route::get('/store/register', 'Store@register');
Route::post('/store/register', 'Store@registerAction');
Route::get('/store/login', 'Store@login');
Route::post('/store/login', 'Store@loginAction');
Route::get('/store/logout', 'Store@logout');
Route::get('/store/checkout', 'Store@checkout');
Route::post('/store/checkout', 'Store@checkoutAction');
Route::get('/store/orders', 'Store@orders');
Route::get('/store/message/{id?}', 'Store@message');