<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', 'HomeController@spa')->where('any', '.*');

Route::get('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

Auth::routes();