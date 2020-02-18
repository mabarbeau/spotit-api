<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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


Route::post('log/info', function(Request $request){
    Log::info($request->all());
});
Route::post('log/warning', function(Request $request){
    Log::warning($request->all());
});
Route::post('log/error', function(Request $request){
    Log::error($request->all());
});