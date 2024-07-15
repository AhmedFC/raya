<?php

namespace App\Repositories\Eloquent\API;
use App\Models\Task;
use App\Models\Project;
use App\Traits\GeneralTrait;
use App\Repositories\Eloquent\Repository;
use App\Interfaces\Eloquent\API\EndPointsEloquent;

class EndPointsRepo extends Repository implements EndPointsEloquent
{
    use GeneralTrait;
    public function __construct()
    {

    }

    public function getProjects()
    {
        $projects = Project::all();

        return $this->returnData($projects,'تم استرجاع البيانات بنجاح');
    }

    public function getTasks()
    {
        $tasks = Task::all();

        return $this->returnData($tasks,'تم استرجاع البيانات بنجاح');
    }


}
