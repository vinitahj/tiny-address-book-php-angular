<?php

namespace App\Models;

use App\Repositories\GroupRepository;

class Group
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function getAll($offset = 0, $limit = 10)
    {
        return $this->groupRepository->getAll($offset, $limit);
    }

    public function create($data)
    {
        return $this->groupRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->groupRepository->update($data, $id);
    }

    public function findById($id)
    {
        return $this->groupRepository->findById($id);
    }

    public function deleteById($id)
    {
        return $this->groupRepository->deleteById($id);
    }
}
