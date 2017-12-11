<?php

/**
 * Created by PhpStorm.
 * User: NCCSoft
 * Date: 9/11/2017
 * Time: 2:02 PM
 */

namespace App\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class UserService extends Service
{
    private $userModel;

    function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getAllUser()
    {
        return $this->userModel->all();
    }

    public function registerUser(Request $request){
        if($this->userModel->where([
            'name'=>$request->name,
            'email'=>$request->email,
            'game_id'=>$request->game_id
        ])->first()) {
            throw new \Exception('User exists');
        };

        return $this->userModel->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'game_id'=>$request->game_id,
            'password'=>bcrypt($request->password)
        ]);
    }

    public function loginUser(Request $request){
        $credentials = $request->only('email','password', 'game_id');
        $token = JWTAuth::attempt($credentials);

        return $token;
    }
}