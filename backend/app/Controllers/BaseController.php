<?php

namespace App\Controllers;

class BaseController
{

    public function __construct()
    {
        $this->setJsonHeader();
    }

    protected  function setJsonHeader()
    {
        header('Content-Type: application/json');
    }

    public function index()
    {
        echo json_encode(['message' => 'Welcome to Address Book Application API']);
    }
}
