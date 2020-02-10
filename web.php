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

//Route::resource('fields', 'FieldsController');

Route::get('/fields', 'FieldsController@index');
Route::get('/fields/{lang}/{id}','FieldsController@single');
Route::post('/fields/{lang}/{id}','FieldsController@single_post');


