<?php

use App\Http\Route;
use App\Controllers\BaseController;
use App\Controllers\CityController;
use App\Controllers\ContactsController;


// Define routes
Route::add('GET', '/', 'BaseController@index');

Route::add('GET', '/migrate', 'BaseController@migrate');

Route::add('GET', '/contacts', 'ContactsController@index');
Route::add('POST', '/contacts', 'ContactsController@store');
Route::add('GET', '/contacts/{id}', 'ContactsController@show');
Route::add('PUT', '/contacts/{id}', 'ContactsController@update');
Route::add('DELETE', '/contacts/{id}', 'ContactsController@destroy');

Route::add('GET', '/cities', 'CityController@index');

Route::add('GET', '/contacts/export/{type}', 'ContactsController@export');
