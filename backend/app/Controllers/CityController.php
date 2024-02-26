<?php

namespace App\Controllers;

use App\Models\City;
use App\Repositories\CityRepository;

class CityController extends BaseController
{
    private $cityModel;

    public function __construct()
    {
        parent::__construct();
        $cityRepository = new CityRepository($this->db);
        $this->cityModel = new City($cityRepository);
    }

    // Return all cities as JSON
    public function index()
    {
        $cities = $this->cityModel->getAll();
        echo json_encode($cities);
    }
}
