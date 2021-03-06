<?php

namespace App\Http\Controllers\UserProfile;

use App\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserProfileController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userProfiles = UserProfile::All();

        return $this->showAll($userProfiles);
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
        'name' => 'required'
        ];

        $this->validate($request,$rules);

        $userProfile = new UserProfile();
        $userProfile->name = $request->name;
        $userProfile->save();

        return $this->showOne($userProfile, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        return $this->showOne($userProfile);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function cleanTasks(UserProfile $userProfile)
    {
        $tasks = $userProfile->tasks;
        foreach ($tasks as $task ) {
            $task->delete();
        }
        return $this->showAll($tasks);
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
        $rules = [
            'name' => 'required'
        ];

        $this->validate($request,$rules); 
        
        $userProfile->name = $request->name;
        $userProfile->save();

        return $this->showOne($userProfile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {   
        $users = $userProfile->users()->get();
        if(sizeof($users) == 0 ){
            $userProfile->delete();
            return $this->showOne($userProfile);   
        }else{
            return $this->errorResponse("El perfil no puede ser eliminado ya que existen usuarios relacionados",409);
        }

    }
}
