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
    public function index(user $user)
    {
        $containerTasks = $user->containerTasks;
        return $this->showAll($containerTasks);        
    }

}
