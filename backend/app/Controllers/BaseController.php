<?php

namespace App\Controllers;

class BaseController
{
    public function index()
    {
        echo json_encode(['message' => 'Welcome to Address Book Application API']);
    }
}
