<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $rules = [
            'email' => 'required | email',
            'password' => 'required | min:4'
        ];

        $this->validate($request,$rules);
        $user = User::where(
        		['email',$request->email],
        		['password',bcrypt($request->password)]
        	)->firstOrFail();            

        return $this->showOne($user);
    }
}
