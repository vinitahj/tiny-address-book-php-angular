<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once __DIR__ . '/../vendor/autoload.php';

use Config\EnvLoader;
// Load environment variables
EnvLoader::load();

echo getenv('APP_URL');
