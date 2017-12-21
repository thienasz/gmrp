<?php

namespace App\Http\Controllers;

use App\Models\NewRegisterTracker;
use App\Services\NewRegisterTrackerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $userService;
    private $newRegisterTracker;

    public function __construct(UserService $userService, NewRegisterTrackerService $newRegisterTracker)
    {
        $this->userService = $userService;
        $this->newRegisterTracker = $newRegisterTracker;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'game_id'=>'required|exists:games,id',
            'email'=>'required|email|min:6|max:100',
            'password'=>'required|min:6',
            'os_type' => 'required',
            'os_version' => 'required',
            'device_uid' => 'required'
        ], [
            'name'=>'required',
            'game_id'=>'required|exists:games,id',
            'email'=>'required|email|min:6|max:100',
            'password'=>'required|min:6',
            'os_type' => 'required',
            'os_version' => 'required',
            'device_uid' => 'required'
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

    public function addNewRegister() {
        return response()->jsonOk($this->newRegisterTracker->addNewRegister());
    }
}
