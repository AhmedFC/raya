<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Eloquent\Admin\TaskRepo;

class TasksController extends Controller
{
    private $taskRepo;

    public function __construct(TaskRepo $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function index()
    {
        $project = $this->taskRepo->index();
        return $project;
    }
    public function getTasks()
    {
        $tasks = $this->taskRepo->getTasks();
        return $tasks;
    }


    public function store(TaskRequest $request)
    {
        $task = $this->taskRepo->store($request);
        return $task;
    }
    public function edit($id)
    {
        $task = $this->taskRepo->edit($id);
        return $task;
    }

    public function show($id)
    {
        $task = $this->taskRepo->show($id);
        return $task;
    }
    public function update(TaskRequest $request,  $id)
    {

        $task = $this->taskRepo->update($request,$id);
        return $task;
    }
    public function destroy($id)
    {
        $task = $this->taskRepo->destroy($id);
        return $task;
    }
}
