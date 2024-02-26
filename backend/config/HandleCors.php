<?php

namespace Config;

class HandleCors
{
    private static function setCommonHeaders($origin)
    {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
    }

    public static function setHeaders()
    {
        $allowedOrigins = ['http://localhost:4200']; // Define allowed origins

        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        if (in_array($origin, $allowedOrigins)) {
            self::setCommonHeaders($origin);

            // Handle preflight requests
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                header('Access-Control-Max-Age: 1728000');
                header('Content-Length: 0');
                header('Content-Type: text/plain');
                die();
            }
        }
    }
}
