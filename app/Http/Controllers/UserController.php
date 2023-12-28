<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:6'
        ]);
       $logInResult= $this->userService->login($loginUserData['email'],$loginUserData['password']);
        return $this->response("Logged in successfully",$logInResult);
    }

    public function logout(){
        
        $this->userService->logout();
        return$this->response("Logged out");
    }


}
