<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('clients', 'ClientController@index');
Route::get('clients/new-client', 'ClientController@create');
Route::post('clients/new-client', 'ClientController@store');

Route::get('deposits', 'DepositController@index');
Route::get('deposits/new-deposit', 'DepositController@create');
Route::post('deposits/new-deposit', 'DepositController@store');

Route::get('statistic', 'StatisticController@index');
