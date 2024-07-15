<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Eloquent\Admin\ProjectRepo;

class ProjectsController extends Controller
{
    private $projectRepo;

    public function __construct(ProjectRepo $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    public function index()
    {
        $project = $this->projectRepo->index();
        return $project;
    }
    public function getProjects()
    {
        $projects = $this->projectRepo->getProjects();
        return $projects;
    }


    public function store(ProjectRequest $request)
    {
        $project = $this->projectRepo->store($request);
        return $project;
    }
    public function edit($id)
    {
        $project = $this->projectRepo->edit($id);
        return $project;
    }

    public function show($id)
    {
        $project = $this->projectRepo->show($id);
        return $project;
    }
    public function update(ProjectRequest $request,  $id)
    {

        $project = $this->projectRepo->update($request,$id);
        return $project;
    }
    public function destroy($id)
    {
        $project = $this->projectRepo->destroy($id);
        return $project;
    }
}
