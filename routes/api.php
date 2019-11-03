<?php

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');

Route::resource('spots', 'SpotController')->except([
    'create', 'edit'
]);


Route::get('Snapshots/{alias}/{key}', 'SnapshotController@index');
Route::post('Snapshots', 'SnapshotController@restore');