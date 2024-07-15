<?php

namespace App\Repositories\Eloquent\Admin;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;
use App\Repositories\Eloquent\Repository;
use App\Interfaces\Eloquent\Admin\ProjectEloquent;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class ProjectRepo extends Repository implements ProjectEloquent
{

    public function __construct()
    {
        parent::__construct(new Project());
    }


    public function index()
    {
        return view('admin.projects.index');
    }

    public function getProjects()
    {
        $projects = Project::latest()->get();
        return DataTables::of($projects)
            ->addColumn('action', function ($project) {
                $editBtn =  '<a ' .
                    ' class="btn btn-sm btn-success on-default edit-row" ' .
                    ' onclick="editProject(' . $project->id . ')">' .
                    '<i class="fas fa-pencil-alt"></i></a> ';

                $deleteBtn =  '<a ' .
                    ' class="btn btn-sm btn-danger on-default remove-row" ' .
                    ' onclick="destroyProject(' . $project->id . ')">' .
                    '<i class="far fa-trash-alt"></i></a> ';

                    return $editBtn . $deleteBtn;

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

        Project::create($data);
        return response()->json(['status' => "success"]);
    }



    public function update($request , $id)
    {
        $validated = $request->validated();
        $project = Project::find($id);
        $project->update($validated);
        return response()->json(['status' => "success"]);
    }

    public function create()
    {

    }

    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json(['brand' => $project]);
    }



    public function show($id)
    {
        $project = Project::find($id);
        return response()->json(['brand' => $project]);
    }

    public function destroy($id)
    {
         Project::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
