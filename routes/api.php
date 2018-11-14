<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\ApiController@register')->name('register');
Route::post('login', 'Api\ApiController@login')->name('login');
Route::post('add-pain', 'Api\ApiController@addPain')->name('add pain');
Route::post('add-therapy', 'Api\ApiController@addTherapy')->name('add therapy');
Route::post('add-patient', 'Api\ApiController@addPatient')->name('add patient');
Route::post('assign-patient', 'Api\ApiController@assignPatient')->name('assign patient');
Route::get('patients', 'Api\ApiController@patients')->name('patients');
Route::get('medicines', 'Api\ApiController@medicines')->name('medicines');
Route::get('pain-history', 'Api\ApiController@painHistory')->name('pain history');
Route::get('therapy-history', 'Api\ApiController@therapyHistory')->name('therapy history');