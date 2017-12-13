<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'game_id'=>'required',
            'email'=>'required|email|min:6|max:100|unique:users,email',
            'password'=>'required|min:6'
        ]);

        return response()->jsonOk($this->userService->registerUser($request));
    }
}
