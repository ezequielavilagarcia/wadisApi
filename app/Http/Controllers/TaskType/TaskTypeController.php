<?php

namespace App\Http\Controllers\TaskType;

use App\TaskType;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TaskTypeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskTypes = TaskType::All();

        return $this->showAll($taskTypes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
        "name" => 'required',
        "description" => 'required'
        ];

        $this->validate($request,$rules);

        $taskType = new TaskType();
        $taskType->name = $request->name;
        $taskType->description = $request->description;
        $taskType->save();

        return $this->showOne($taskType, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function show(TaskType $taskType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskType $taskType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskType $taskType)
    {
        //
    }
}
