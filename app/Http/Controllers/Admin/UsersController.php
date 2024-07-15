<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\Eloquent\Admin\UserRepo;
use App\Http\Requests\Admin\UpdateUserRequest;

class UsersController extends Controller
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $user = $this->userRepo->index();
        return $user;
    }
    public function getUsers()
    {
        $users = $this->userRepo->getUsers();
        return $users;
    }


    public function store(UserRequest $request)
    {
        $user = $this->userRepo->store($request);
        return $user;
    }
    public function edit($id)
    {
        $user = $this->userRepo->edit($id);
        return $user;
    }

    public function show($id)
    {
        $user = $this->userRepo->show($id);
        return $user;
    }
    public function update(UpdateUserRequest $request,  $id)
    {

        $user = $this->userRepo->update($request,$id);
        return $user;
    }
    public function destroy($id)
    {
        $user = $this->userRepo->destroy($id);
        return $user;
    }

    public function showUserActivity($id)
    {
        $user = $this->userRepo->showUserActivity($id);
        return $user;
    }

    public function getUserActivity()
    {
        $user = $this->userRepo->getUserActivity();
        return $user;
    }


}
