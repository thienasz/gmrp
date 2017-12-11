<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $token = $this->userService->loginUser($request);

        if (!$token){
            return response()->jsonError('invalid_credentials');
        }

//        $user = JWTAuth::parseToken()->authenticate();

        $user = Auth::user();

        return response()->jsonOk(["token"=>$token,"profile"=>$user]);
    }

    public function logout(){
        $token = JWTAuth::getToken();
        if ($token){
            JWTAuth::invalidate($token);
            return response()->jsonOk(["Message"=>"Logout Successfully!"]);
        }else{
            return response()->json(["Message"=>"Logout Failed!"]);
        }
    }
}
