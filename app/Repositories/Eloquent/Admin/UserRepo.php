<?php

namespace App\Repositories\Eloquent\Admin;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use App\Repositories\Eloquent\Repository;
use App\Interfaces\Eloquent\Admin\UserEloquent;

class UserRepo extends Repository implements UserEloquent
{

    public function __construct()
    {
        parent::__construct(new User());
    }


    public function index()
    {
        return view('admin.users.index');
    }

    public function getUsers()
    {
        $users = User::latest()->get();
        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $status = $user->status == 1 ? 'مفعل': 'غير مفعل';
                $class = $user->status == 1 ? 'class="btn btn-sm btn-success on-default remove-row"': 'class="btn btn-sm btn-danger on-default remove-row"';
                $url = route('admin.showUserActivity',$user->id);


                $editBtn =  '<a ' .
                    ' class="btn btn-sm btn-success on-default edit-row" ' .
                    ' onclick="editProject(' . $user->id . ')">' .
                    '<i class="fas fa-pencil-alt"></i></a> ';

                $deleteBtn =  '<a ' .
                    ' class="btn btn-sm btn-danger on-default remove-row" ' .
                    ' onclick="destroyProject(' . $user->id . ')">' .
                    '<i class="far fa-trash-alt"></i></a> ';
                    $activityBtn = '<a ' .
                    ' class="btn btn-primary" ' .
                    ' href='.$url  .
                    '>' .
                    'Show Activity</a> ';

                    return  $activityBtn.$editBtn . $deleteBtn;

            })
            ->rawColumns(
                [
                    'action',
                ])
            ->make(true);
    }

    public function store($request)
    {
        $data = $request->validated();
       $data['password'] = Hash::make($request->password);
      $user = User::create($data);
      $user->assignRole($request->type);
        return response()->json(['status' => "success"]);
    }



    public function update($request , $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $validated['password'] = $request->password ? Hash::make($request->password) : $user->password;
        $user->update($validated);
        $user->syncRoles($request->type);
        return response()->json(['status' => "success"]);
    }

    public function create()
    {
        $permission = Permission::get();
        $groups = array_keys(config()->get('permission_groups.groups'));
        return view('admin.roles.create', compact('permission', 'groups'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['brand' => $user]);
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $groups = array_keys(config()->get('permission_groups.groups'));
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions', 'groups'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['brand' => $user]);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['status' => "success"]);
    }


    public function getUserActivity()
    {
        $user = User::find(\request()->user_id);
       $activities = Activity::inLog('default')
       ->causedBy($user)
       ->get();
       return DataTables::of($activities)
       ->make(true);
    }

    public function getBalances()
    {
        if(\request()->user_id) {
            $user = User::find(\request()->user_id);
            $totalDepositAmount = $user->deposit;
            $engine_sizes = Deposit::with('user')->where('user_id',\request()->user_id)->orderBy('created_at','desc')->latest()->get();
            $data = DataTables::of($engine_sizes)
                ->with('totalDepositAmount',$totalDepositAmount)
                ->make(true);
            $tableData = $data->original;
            $tableData['totalDepositAmount'] = $totalDepositAmount;
           return $tableData;
        } else {
            $engine_sizes = Deposit::with('user')->latest()->get();
            return DataTables::of($engine_sizes)
                ->make(true);
        }

    }

    public function showUserActivity($id)
    {
        $user_id = $id;
        return view('admin.user_activity.index',compact('user_id'));
    }
}
