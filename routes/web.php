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

Route::get('/', 'IndexController@home')->name('home');
Route::get('/run-seed', 'IndexController@freshSeed')->name('freshseed');

Route::post('/users/{user}/seed', 'UserController@seed')->name('users.seed');
Route::resource('users', 'UserController');
Route::resource('users.ips', 'UserIpController')->only(['store', 'update', 'destroy']);
Route::resource('products', 'ProductController')->except(['show']);
