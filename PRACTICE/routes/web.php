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

Route::get("/bakery/menu/{id?}", 'Bakery@menu');
Route::get("/bakery/register", 'Bakery@register');
Route::post("/bakery/register", 'Bakery@registerAction');
Route::get("/bakery/activate/{token}", 'Bakery@activate');