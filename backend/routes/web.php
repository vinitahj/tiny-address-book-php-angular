<?php

use App\Http\Route;
use App\Controllers\BaseController;
use App\Controllers\CityController;
use App\Controllers\ContactsController;
use App\Controllers\GroupsController;


// Define routes
Route::add('GET', '/', 'BaseController@index');

Route::add('GET', '/migrate', 'BaseController@migrate');

Route::add('GET', '/contacts', 'ContactsController@index');
Route::add('POST', '/contacts', 'ContactsController@store');
Route::add('GET', '/contacts/{id}', 'ContactsController@show');
Route::add('PUT', '/contacts/{id}', 'ContactsController@update');
Route::add('DELETE', '/contacts/{id}', 'ContactsController@destroy');

Route::add('GET', '/groups', 'GroupsController@index');
Route::add('POST', '/groups', 'GroupsController@store');
Route::add('GET', '/groups/{id}', 'GroupsController@show');
Route::add('PUT', '/groups/{id}', 'GroupsController@update');
Route::add('DELETE', '/groups/{id}', 'GroupsController@destroy');
Route::add('GET', '/cities', 'CityController@index');

Route::add('GET', '/contacts/export/{type}', 'ContactsController@export');
