<?php

namespace App\Http\Controllers\User;

use App\User;
use App\UserProfile;
use App\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::All();
        return $this->showAll($users);
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
            'username' => 'required | min:4 | unique:users',
            'name' => 'required | min:4',
            'last_name' => 'required | min:2',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:4 | confirmed',
            'identification' => 'required',
            'root' => 'required | int',
            'user_profile_id' => 'required | int',
            'zone_id' => 'int'
        ];

        $this->validate($request,$rules);
        if($request->zone_id){
            $zone = Zone::where('id',$request->zone_id)->firstOrFail();            
        }
        $userProfile = UserProfile::where('id',$request->user_profile_id)->firstOrFail();

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        //$user->password = bcrypt($request->password);
        $user->password = $request->password;
        $user->identification = $request->identification;
        $user->root = $request->root;
        $user->user_profile_id = $request->user_profile_id;
        $user->zone_id = $request->zone_id;
        $user->save();

        return $this->showOne($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'min:4',
            'name' => 'min:4',
            'last_name' => 'min:2',
            'email' => 'email',
            'root' => 'int',
            'user_profile_id' => 'int',
            'zone_id' => 'int'
        ];

        $this->validate($request,$rules);
        
        $user->username = $request->username;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->identification = $request->identification;
        $user->root = $request->root;
        $user->user_profile_id = $request->user_profile_id;
        $user->zone_id = $request->zone_id;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->showOne($user);
    }
}
