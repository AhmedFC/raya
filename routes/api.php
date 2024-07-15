<?php

use App\Http\Controllers\API\EndPointsController;

Route::controller(EndPointsController::class)->group(function () {
    Route::get('getProjects',  'getProjects');
    Route::get('getTasks',  'getTasks');
});

