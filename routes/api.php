<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('me', 'UserController@me');
Route::post('auth/login', 'AuthController@login');
Route::post('auth/refresh', 'AuthController@refresh');

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