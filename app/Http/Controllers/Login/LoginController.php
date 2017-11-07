<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class LoginController extends ApiController
{
    public function login(Request $request){
        $rules = [
            'email' => 'required | email',
            'password' => 'required'
        ];

        $this->validate($request,$rules);
        $user = User::
        where('email',$request->email)
        ->where('password',$request->password)
        ->firstOrFail();            

        return $this->showOne($user);
    }
    public function loginWeb(Request $request){
        $rules = [
            'email' => 'required | email',
            'password' => 'required'
        ];

        $this->validate($request,$rules);
        $user = User::
        where('email',$request->email)
        ->where('password',$request->password)
        ->where('root',1)
        ->firstOrFail();            

        return $this->showOne($user);
    }
}
