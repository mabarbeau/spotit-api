<?php
use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'AuthController@login');
Route::post('auth/refresh', 'AuthController@refresh');

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
Route::get('me', 'UserController@me');

Route::resource('spots', 'SpotController')->except([
    'create', 'edit'
]);

Route::resource('sports', 'SportController')->except([
    'create', 'edit'
]);

Route::get('updates', 'UpdateController@index');