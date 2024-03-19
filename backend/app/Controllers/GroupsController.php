<?php

namespace App\Controllers;

use App\Models\Group;
use App\Repositories\GroupRepository;

class GroupsController extends BaseController
{
    private $groupModel;

    public function __construct()
    {
        parent::__construct();
        $groupRepository = new GroupRepository($this->db);
        $this->groupModel = new Group($groupRepository);
    }

    // Return all groups as JSON
    public function index()
    {

        $groups = $this->groupModel->getAll();
        echo json_encode($groups);
    }

    // Receive JSON data to store a new group
    public function store()
    {
        $data = $this->getPostData();
        $newData = $this->groupModel->create($data);
        echo json_encode(['message' => 'Group created successfully', 'data' => $newData]);
    }

    // Return a single group for editing
    public function show($id)
    {
        $group = $this->groupModel->findById($id);
        echo json_encode($group);
    }

    // Receive JSON data to update an existing group
    public function update($id)
    {
        $data = $this->getPostData();
        $updatedData = $this->groupModel->update($data, $id);
        echo json_encode(['message' => 'Group updated successfully', 'data' => $updatedData]);
    }

    public function destroy($id)
    {
        $this->groupModel->deleteById($id);
        echo json_encode(['message' => 'Group Deleted successfully']);
    }
}
