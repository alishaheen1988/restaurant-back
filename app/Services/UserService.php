<?php

namespace App\Services;

use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function login($email, $password)
    {
        $user = User::where('email',$email)->first();
        if(!$user || !\Hash::check($password,$user->password)){
            throw new NotFoundHttpException('User not found');
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        $user->token=$token;
        $this->categoryService->addRootCategory($user->id);
        return $user;
    }

    public function logout()
    {
        \Auth::user()->tokens()->delete();
    }

}