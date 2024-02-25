<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';

use Config\EnvLoader;
use App\Http\Route;
use Config\HandleCors;

// Load environment variables
EnvLoader::load();

// Set CORS Headers
HandleCors::setHeaders();

// Load the routes
$appUrl = getenv('APP_URL');
// Parse URL to get the path part
$appUrlPath = parse_url($appUrl, PHP_URL_PATH);

// Parse the current request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Use the path from APP_URL as the base path
$basePath = rtrim($appUrlPath, '/');

// Remove the base path from $requestUri
$relativePath = preg_replace('#^' . preg_quote($basePath) . '#', '', $requestUri);

// Handle the request
Route::run($relativePath, $_SERVER['REQUEST_METHOD']);
