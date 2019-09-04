<?php

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
