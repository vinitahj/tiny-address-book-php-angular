<?php

namespace App\Models;

use App\Repositories\ContactRepository;

class Contact
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAll($offset = 0, $limit = 10)
    {
        return $this->contactRepository->getAll($offset, $limit);
    }

    public function create($data)
    {
        return $this->contactRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->contactRepository->update($data, $id);
    }

    public function findById($id)
    {
        return $this->contactRepository->findById($id);
    }

    public function deleteById($id)
    {
        return $this->contactRepository->deleteById($id);
    }
}
