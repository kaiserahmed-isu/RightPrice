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


Route::post('amazon', 'AmazonController@search');
Route::post('compare', 'EbayController@search');

Route::get('/testam', function () {
    return view('testam');
});

Route::get('/testebay', function () {
    return view('testebay');
});
