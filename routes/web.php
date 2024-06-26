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
  Route::get('/clear', function() {

           Artisan::call('cache:clear');
           Artisan::call('config:clear');
           Artisan::call('config:cache');
           Artisan::call('view:clear');
           Artisan::call('view:cache');
           Artisan::call('route:clear');
        
           return "Cleared!";
        
        });
Route::get('/', 'indexController@index');
Route::get('/sendMail', 'indexController@sendMail')->name('sendmail');

