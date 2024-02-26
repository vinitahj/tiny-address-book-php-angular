<?php

namespace App\Models;

use App\Repositories\CityRepository;

class City
{
    private $cityRepository;
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    // Get all cities from the database
    public function getAll()
    {
        return $this->cityRepository->getAll();
    }
}
