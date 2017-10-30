<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\ApiController;
use App\Task;
use App\TaskType;
use App\UserProfile;
use Illuminate\Http\Request;

class UserProfileTaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(userProfile $userProfile)
    {
        $tasks = $userProfile->tasks;

        return $this->showAll($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(userProfile $userProfile, TaskType $taskType, Request $request)
    {
        $task = new Task();
        $task->task_type_id = $taskType->id;
        $task->user_profile_id = $userProfile->id;
        $task->save();

        return $this->showOne($task);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile, TaskType $taskType, Request $request)
    {
        $task = Task::where('user_profile_id',$userProfile->id)
                                    ->where("task_type_id",$taskType->id)->firstOrFail();
        $task->delete();
        return $this->showOne($task);
    }
}
