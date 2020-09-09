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
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('allcategories', 'Home@ListAll');
Route::get('Index/{id?}', 'Home@List');
Route::get('login/{provider}', 'Auth\SocialAcountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAcountController@handleProviderCallback');
Route::get('/{any?}', function () {
    return view('welcome');
});
