<?php

namespace App\Http\Controllers;

use App\Services\GameSessionTrackerService;
use App\Services\UserService;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTFactory;


class LoginController extends Controller
{
    private $userService;
    private $gameSessionTrackerService;

    public function __construct(UserService $userService, GameSessionTrackerService $gameSessionTrackerService)
    {
        $this->userService = $userService;
        $this->gameSessionTrackerService = $gameSessionTrackerService;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'password'=>'required',
            'game_id'=>'required|exists:games,id',
            'email'=>'required|email|min:6|max:100',
            'os_type' => 'required',
            'os_version' => 'required',
            'device_uid' => 'required'
        ], [
            'password'=>'required',
            'game_id'=>'required|exists:games,id',
            'email'=>'required|email|min:6|max:100',
            'os_type' => 'required',
            'os_version' => 'required',
            'device_uid' => 'required'
        ]);
        $token = $this->userService->loginUser($request);

        if (!$token){
            return response()->jsonError('invalid_credentials');
        }

        $this->gameSessionTrackerService->startGameSession($request);
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
            'game_id'=>'required|exists:games,id',
            'os_type' => 'required',
            'os_version' => 'required',
            'device_uid' => 'required'
        ], [
            'fb_uid'=>'required',
            'fb_token'=>'required',
            'game_id'=>'required|exists:games,id',
            'os_type' => 'required',
            'os_version' => 'required',
            'device_uid' => 'required'
        ]);

        $token = $this->userService->fbLoginUser($request);

        if (!$token){
            return response()->jsonError('invalid_credentials');
        }

//        $user = JWTAuth::parseToken()->authenticate();
        $this->gameSessionTrackerService->startGameSession($request);

        $user = Auth::user();
        $exp = JWTFactory::exp();
        return response()->jsonOk(["token"=>$token,"profile"=>$user, "expire" => $exp]);
    }

    public function refresh(){
        $token = JWTAuth::getToken();
        $new_token = JWTAuth::refresh($token);

        return response()->jsonOk(["token"=>$new_token]);
    }

    public function offline(){
        $this->gameSessionTrackerService->endGameSession();

        return response()->jsonOk("Ok");
    }

    public function logout(){
        $token = JWTAuth::getToken();
        if ($token){
            $this->gameSessionTrackerService->endGameSession();

            JWTAuth::invalidate($token);
            return response()->jsonOk(["Message"=>"Logout Successfully!"]);
        }else{
            return response()->json(["Message"=>"Logout Failed!"]);
        }
    }
}
