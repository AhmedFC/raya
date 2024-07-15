<?php

namespace App\Repositories\Eloquent\Admin;


use App\Models\User;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Crypt;
use App\Repositories\Eloquent\Repository;
use App\Interfaces\Eloquent\Admin\AuthEloquent;
use Illuminate\Support\Facades\Auth;

class AuthRepo extends Repository implements AuthEloquent
{

    public function __construct()
    {
        parent::__construct(new User());
    }


    public function login()
    {
        $user = User::where('email', request()->email)->first();
        if ($user && $user->type == 'admin') {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function adminLogout()
    {
        Auth::logout();
    }
}
