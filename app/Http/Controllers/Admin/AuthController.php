<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquent\Admin\AuthRepo;

class AuthController extends Controller
{
    private $authRepo;

    public function __construct(AuthRepo $authRepo)
    {
        $this->authRepo = $authRepo;
    }
    public function login()
    {
        $user = $this->authRepo->login();
        if ($user) {
            return redirect()->route('admin.home');
        }
        return back()->with('error', 'نأسف لكن كلمة المرور أو البريد الالكتروني غير صحيح');
    }
    public function logout()
    {
        $this->authRepo->adminLogout();
        return redirect('/admin/login');
    }
}
