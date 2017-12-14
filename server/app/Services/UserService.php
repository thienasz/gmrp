<?php

/**
 * Created by PhpStorm.
 * User: NCCSoft
 * Date: 9/11/2017
 * Time: 2:02 PM
 */

namespace App\Services;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class UserService extends Service
{
    private $userModel;
    private $userDetails;

    function __construct(User $userModel, UserDetails $userDetails)
    {
        $this->userModel = $userModel;
        $this->userDetails = $userDetails;
    }

    public function getAllUser($perPage = 15, $role = false)
    {
        if($role === false) {
            return $this->userModel->with(['game', 'userDetail'])->paginate($perPage);
        }

        return $this->userModel->where('role', $role)->with(['game', 'userDetail'])->orderBy('id', 'desc')->paginate($perPage);
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

    public function getUser($data){
        return $this->userModel->where($data)->first();
    }

    public function loginUser(Request $request){
        $credentials = $request->only('email','password', 'game_id');
        $token = JWTAuth::attempt($credentials);

        return $token;
    }

    public function adminLoginUser(Request $request){
        $credentials = $request->only('username','password');
        $credentials['role'] = 1;

        $token = JWTAuth::attempt($credentials);

        return $token;
    }

    public function fbLoginUser(Request $request){
        $pass = str_random(8);
        $user = $this->userModel->updateOrCreate(
            ['fb_uid' => $request['fb_uid']],
            [
                'fb_token' =>  $request['fb_token'],
                'email' => $request['email'],
                'game_id' => $request['phone'],
                'password' => bcrypt($pass),
                'role' => 2,
            ]
        );

        $this->userDetails->updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
            ]
        );

        $credentials = [
            'fb_uid' => $user->fb_uid,
            'fb_token' => $user->fb_token,
            'game_id' => $user->game_id,
            'password' => $pass
        ];

        $token = JWTAuth::attempt($credentials);

        return $token;
    }
}