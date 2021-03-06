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

Route::get('registration','RegistrationController@Start');
Route::get('login','LoginController@Start');
Route::get('name','ChangeNameController@Start');
Route::get('master_data','MasterDataController@Get');
Route::get('master_data_size','MasterDataController@GetSize');