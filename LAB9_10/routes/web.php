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

Route::get('/', 'Blog@index') -> name('home');
Route::get('/blog/', 'Blog@index') -> name('home');
Route::get('/blog/register', 'Blog@register') -> name('register');
Route::post('/blog/register_action', 'Blog@register_action') -> name('register_action');
Route::get('/blog/login', 'Blog@login') -> name('login');
Route::post('/blog/login_action', 'Blog@login_action') -> name('login_action');
Route::get('/blog/logout', 'Blog@logout') -> name('logout');
Route::get('/blog/password_reset', 'Blog@password_reset') -> name('password_reset');
Route::get('/blog/post/{blog_id?}', 'Blog@post') -> name('post');
Route::post('/blog/post_action/{blog_id?}', 'Blog@post_action') -> name('post_action');