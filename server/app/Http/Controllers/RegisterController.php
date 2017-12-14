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
            'game_id'=>'required|exists:games,id',
            'email'=>'required|email|min:6|max:100',
            'password'=>'required|min:6',
        ], [
            'name'=>'required',
            'game_id'=>'required|exists:games,id',
            'email'=>'required|email|min:6|max:100',
            'password'=>'required|min:6',
        ]);

        $user = $this->userService->getUser([
            'game_id' => $request->game_id,
            'email' => $request->email,
        ]);

        if($user) {
            response()->jsonError("User exists");
        }

        return response()->jsonOk($this->userService->registerUser($request));
    }
}
