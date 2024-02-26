<?php

use App\Http\Route;
use App\Controllers\BaseController;
use App\Controllers\CityController;
use App\Controllers\AddressBookController;


// Define routes
Route::add('GET', '/', 'BaseController@index');

Route::add('GET', '/migrate', 'BaseController@migrate');

Route::add('GET', '/entries', 'AddressBookController@index');
Route::add('POST', '/entries', 'AddressBookController@store');
Route::add('GET', '/entries/{id}', 'AddressBookController@show');
Route::add('PUT', '/entries/{id}', 'AddressBookController@update');
Route::add('DELETE', '/entries/{id}', 'AddressBookController@destroy');

Route::add('GET', '/cities', 'CityController@index');

Route::add('GET', '/entries/export/{type}', 'AddressBookController@export');
