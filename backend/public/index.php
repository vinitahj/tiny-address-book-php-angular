<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once __DIR__ . '/../vendor/autoload.php';

use Config\EnvLoader;
use Config\Database;
// Load environment variables
EnvLoader::load();

// Connect Database
$db = (new Database())->connect();
