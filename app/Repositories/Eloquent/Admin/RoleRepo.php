<?php

namespace App\Repositories\Eloquent\Admin;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\Eloquent\Repository;
use App\Interfaces\Eloquent\Admin\RoleEloquent;

class RoleRepo extends Repository implements RoleEloquent
{

    public function __construct()
    {
        parent::__construct(new Role());
    }


    public function index()
    {
        return view('admin.roles.index');
    }

    public function getRoles()
    {
        $roles = Role::latest()->get();

        return DataTables::of($roles)
            ->addColumn('action', function ($role) {

                $url = route('admin.editRole',$role->id);
                $updateBtn = '<a ' .
                    ' class="btn btn-primary" ' .
                    ' href='.$url  .
                    '>' .
                    '<i class="fas fa-pen"></i></a> ';

                $deleteBtn =  '<a ' .
                    ' class="btn btn-sm btn-danger on-default remove-row" ' .
                    ' onclick="destroyProject(' . $role->id . ')">' .
                    '<i class="far fa-trash-alt"></i></a> ';

                return  $updateBtn . $deleteBtn;
            })
            ->rawColumns(
                [
                    'action',
                ])
            ->make(true);
    }

    public function store($request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permissions);

        activity()
            ->performedOn($role)
            ->causedBy(auth()->user())  // You need to have user authentication for this
            ->log('Created new role: ' . $role->name);

        return redirect()->route('admin.roles.index')->with('success', __('Successfully added'));
    }

    public function update($request , $id)
    {
        $role = Role::find($id);
        $oldRole = $role->getOriginal();
        $role->update([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permissions);
        activity()
        ->performedOn($role)
        ->causedBy(auth()->user())  // You need to have user authentication for this
        ->withProperties(['old' => $oldRole, 'new' => $role->getAttributes()])
        ->log('Updated role: ' . $role->name);
        return redirect()->route('admin.roles.index')->with('success', __('Successfully updated'));
    }

    public function create()
    {
        $permission = Permission::get();
        $groups = array_keys(config()->get('permission_groups.groups'));
        return view('admin.roles.create', compact('permission', 'groups'));
    }

    public function edit($id)
    {
        $brand = Role::find($id);
        return response()->json(['brand' => $brand]);
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
        $role = Role::find($id);
        return response()->json(['brand' => $role]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        // Optionally store a copy of the role before deleting for logging purposes
        $deletedRole = clone $role;


        // Perform the deletion
        $role->delete();
        activity()
        ->performedOn($role)
        ->causedBy(auth()->user())  // Make sure you have user authentication for this
        ->withProperties(['old' => $deletedRole])
        ->log('Deleted role: ' . $deletedRole->name);
        return response()->json(['status' => "success"]);
    }
}
