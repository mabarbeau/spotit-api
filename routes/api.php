<?php

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');

Route::resource('spots', 'SpotController')->except([
    'create', 'edit'
]);

Route::resource('sports', 'SportController')->except([
    'create', 'edit'
]);