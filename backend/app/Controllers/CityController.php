<?php

namespace App\Controllers;

use App\Models\City;

class CityController extends BaseController
{
    private $cityModel;

    public function __construct()
    {
        parent::__construct();
        $this->cityModel = new City($this->db);
    }

    // Return all cities as JSON
    public function index()
    {
        $cities = $this->cityModel->getAll();
        echo json_encode($cities);
    }
}
