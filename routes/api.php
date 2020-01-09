<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('disiplinaryes', 'DisiplinaryController');
Route::get('disiplinaryes/delete/{id}', 'DisiplinaryController@delete');
