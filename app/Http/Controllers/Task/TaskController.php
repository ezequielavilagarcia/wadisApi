<?php

namespace App\Http\Controllers\Task;

use App\Task;
use App\TaskType;
use App\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::All();

        return $this->showAll($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'task_type_id' => 'required',
        'user_profile_id' => 'required'
        ];


        $this->validate($request,$rules);   
        $taskType = TaskType::where('id',$request->task_type_id)->firstOrFail();
        $taskType = UserProfile::where('id',$request->user_profile_id)->firstOrFail();

        $task = new Task();
        $task->task_type_id = $request->task_type_id;
        $task->user_profile_id = $request->user_profile_id;
        $task->save();

        return $this->showOne($task,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
