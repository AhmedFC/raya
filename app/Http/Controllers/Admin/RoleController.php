<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;

use App\Repositories\Eloquent\Admin\RoleRepo;

class RoleController extends Controller
{
    private $roleRepo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
       $role = $this->roleRepo->index();
       return $role;
    }
    public function getRoles()
    {
        $roles = $this->roleRepo->getRoles();
        return $roles;
    }

    public function store(RoleRequest $request)
    {

        $role = $this->roleRepo->store($request);
        return $role;

    }
    public function update(RoleRequest $request , $id)
    {
        $role = $this->roleRepo->update($request,$id);
        return $role;

    }


    public function create()
    {
        $role = $this->roleRepo->create();
        return $role;
    }


    public function edit($id)
    {
        $role = $this->roleRepo->edit($id);
        return $role;
    }

    public function editRole($id)
    {
        $role = $this->roleRepo->editRole($id);
        return $role;
    }



    public function show($id)
    {
        $role = $this->roleRepo->show($id);
        return $role;
    }
    public function destroy($id)
    {
        $role = $this->roleRepo->destroy($id);
        return $role;
    }


}
