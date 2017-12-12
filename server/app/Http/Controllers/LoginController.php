<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTFactory;


class LoginController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'password'=>'required',
            'game_id'=>'required',
            'email'=>'required|email|min:6|max:100',
        ], [
            'password'=>'required',
            'game_id'=>'required',
            'email'=>'required|email|min:6|max:100',
        ]);
        $token = $this->userService->loginUser($request);

        if (!$token){
            return response()->jsonError('invalid_credentials');
        }

//        $user = JWTAuth::parseToken()->authenticate();

        $user = Auth::user();
        $exp = JWTFactory::exp();
        return response()->jsonOk(["token"=>$token,"profile"=>$user, "expire" => $exp]);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username'=>'required',
            'password'=>'required',
        ], [
            'username'=>'required',
            'password'=>'required',
        ]);
        $token = $this->userService->adminLoginUser($request);

        if (!$token){
            return response()->jsonError('invalid_credentials');
        }

//        $user = JWTAuth::parseToken()->authenticate();

        $user = Auth::user();
        $exp = JWTFactory::exp();
        return response()->jsonOk(["token"=>$token,"profile"=>$user, "expire" => $exp]);
    }

    public function fbLogin(Request $request)
    {
        $this->validate($request, [
            'fb_uid'=>'required',
            'fb_token'=>'required',
        ], [
            'username'=>'required',
            'password'=>'required',
            'email'=>'required|email|min:6|max:100',
        ]);

        $token = $this->userService->fbLoginUser($request);

        if (!$token){
            return response()->jsonError('invalid_credentials');
        }

//        $user = JWTAuth::parseToken()->authenticate();

        $user = Auth::user();
        $exp = JWTFactory::exp();
        return response()->jsonOk(["token"=>$token,"profile"=>$user, "expire" => $exp]);
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
