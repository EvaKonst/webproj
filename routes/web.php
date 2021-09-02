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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin_dashboard', 'Admin\DashboardController@index')->middleware('role:admin');
Route::get('/user_dashboard', 'User\DashboardController@index')->middleware('role:user');
Route::post('/user_dashboard', 'User\DashboardController@store')->name('user.dashboard');
Route::get('/change-password', 'User\ChangePasswordController@index')->middleware('role:user');
Route::post('/change-password', 'User\ChangePasswordController@store')->name('change.password');
//Route::resource('/user_dashboard','User\JsonController@index');
//Route::get('/user_dashboard', 'User\JsonController@index')->middleware('role:user');
//Route::post('/user_dashboard', 'User\ChangePasswordController@store')->name('user.dashboard');