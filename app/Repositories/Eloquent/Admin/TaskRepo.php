<?php

namespace App\Repositories\Eloquent\Admin;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;
use App\Repositories\Eloquent\Repository;
use App\Interfaces\Eloquent\Admin\TaskEloquent;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskRepo extends Repository implements TaskEloquent
{

    public function __construct()
    {
        parent::__construct(new Task());
    }


    public function index()
    {
        return view('admin.tasks.index');
    }

    public function getTasks()
    {
        $tasks = Task::latest()->get();
        return DataTables::of($tasks)
            ->addColumn('action', function ($task) {
                $editBtn =  '<a ' .
                    ' class="btn btn-sm btn-success on-default edit-row" ' .
                    ' onclick="editTask(' . $task->id . ')">' .
                    '<i class="fas fa-pencil-alt"></i></a> ';

                $deleteBtn =  '<a ' .
                    ' class="btn btn-sm btn-danger on-default remove-row" ' .
                    ' onclick="destroyTask(' . $task->id . ')">' .
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

        Task::create($data);
        return response()->json(['status' => "success"]);
    }



    public function update($request , $id)
    {
        $validated = $request->validated();
        $task = Task::find($id);
        $task->update($validated);
        return response()->json(['status' => "success"]);
    }

    public function create()
    {

    }

    public function edit($id)
    {
        $task = Task::find($id);
        return response()->json(['brand' => $task]);
    }



    public function show($id)
    {
        $task = Task::find($id);
        return response()->json(['brand' => $task]);
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return response()->json(['status' => "success"]);
    }
}
