<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserContainerTaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $containerTasks = $user->containerTasks;
        return $this->showAll($containerTasks);        
    }

    public function getContainers(User $user)
    {
        $containerTasks = $user->containerTasks()
            ->where('date_execution','<=',date('Y-m-d'))
            ->whereNull('date_done')
            ->get();

        return $this->showAll($containerTasks);        


    }

}
