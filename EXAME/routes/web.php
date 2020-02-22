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

Route::get("/home", 'Shelter@home');
Route::get("/pets/{cat_id?}", 'Shelter@pets');
Route::get("/register", 'Shelter@register');
Route::post("/register", 'Shelter@registerAction');
Route::get("/login", 'Shelter@login');
Route::post("/login", 'Shelter@loginAction');
Route::get("/logout", 'Shelter@logout');
Route::get("/adopt/{pet_id}", 'Shelter@adopt');
Route::get("/mypets", 'Shelter@mypets');