<?php

namespace App\Http\Controllers\ContainerTask;

use App\Task;
use App\User;
use App\Container;
use App\ContainerTask;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ContainerTaskController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
        'date_execution' => 'required | date',  //indica la fecha que debe realizarse la tarea
        'user_id' => 'required | int', // Indica el usuario que debe realizar la tarea
        'task_id' => 'required | int', //indica la tarea a realizarse
        'container_id' => 'required | int' //Indica sobre que contenedor se realizará o se realizo la tarea
        ];

        $this->validate($request,$rules);

        User::where('id',$request->user_id)->firstOrFail();
        Task::where('id',$request->task_id)->firstOrFail();
        Container::where('id',$request->container_id)->firstOrFail();

        $containerTask = new ContainerTask();
        $containerTask->date_execution = $request->date_execution;
        $containerTask->user_id = $request->user_id;
        $containerTask->task_id = $request->task_id;
        $containerTask->container_id = $request->container_id;
        $containerTask->save();

        return $this->showOne($containerTask);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContainerTask  $containerTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContainerTask $containerTask)
    {
        //
    }
}
