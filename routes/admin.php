<?php


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LangController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



/* =============== login ================ */
Route::view('login', 'admin.auth.login')->middleware('admin_guest')->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('admin_guest')->name('login.post');
Route::get('/lang/{lang}',[LangController::class , 'change'])->name('lang');
/* =============== Admin Auth ================ */
Route::group(['middleware' => ['admin']], function () {
    Route::get('/',[DashboardController::class , 'index'])->name('home');

    Route::get("AdminLogout", [AuthController::class, 'logout'])->name("AdminLogout");

    Route::resource('users',UsersController::class);
    Route::get('getUsers',[UsersController::class , 'getUsers'])->name('getUsers');

    Route::resource('projects',ProjectsController::class);
    Route::get('getProjects',[ProjectsController::class , 'getProjects'])->name('getProjects');

    Route::resource('tasks',TasksController::class);
    Route::get('getTasks',[TasksController::class , 'getTasks'])->name('getTasks');
    Route::get('/user/{id}/activity', [UsersController::class , 'showUserActivity'])->name('showUserActivity');
    Route::get('getUserActivity',[UsersController::class , 'getUserActivity'])->name('getUserActivity');

    Route::resource('roles',RoleController::class);
    Route::get('getRoles',[RoleController::class , 'getRoles'])->name('getRoles');
    Route::get('editRole/{id}',[RoleController::class , 'editRole'])->name('editRole');
});


