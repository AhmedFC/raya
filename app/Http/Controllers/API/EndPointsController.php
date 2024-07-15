<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\API\EndPointsRepo;
use App\Traits\GeneralTrait;

class EndPointsController extends Controller
{
    use GeneralTrait;

    private $endPointRepo;

    public function __construct(EndPointsRepo $endPointRepo)
    {
        $this->endPointRepo = $endPointRepo;
    }



    public function getProjects()
    {
        $user = $this->endPointRepo->getProjects();
        return $user;
    }

    public function getTasks()
    {
        $user = $this->endPointRepo->getTasks();
        return $user;
    }
}
