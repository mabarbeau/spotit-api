<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('me', 'UserController@me');
Route::post('auth/login', 'AuthController@login');
Route::put('auth/logout', 'AuthController@logout');

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');

Route::resource('spots', 'SpotController')->except([
    'create', 'edit'
]);

Route::resource('sports', 'SportController')->except([
    'create', 'edit'
]);

Route::get('notifications', 'NotificationController@index');
Route::post('notifications', 'NotificationController@store');
Route::get('notifications/count', 'NotificationController@count');
Route::put('notifications/{notification}/read', 'NotificationController@read');
Route::put('notifications/{notification}/unread', 'NotificationController@unread');
Route::delete('notifications/{notification}', 'NotificationController@destroy');

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