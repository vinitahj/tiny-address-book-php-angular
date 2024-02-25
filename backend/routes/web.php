<?php

use App\Controllers\BaseController;
use App\Http\Route;

// Define routes
Route::add('GET', '/', 'BaseController@index');
Route::add('GET', '/migrate', 'BaseController@migrate');
