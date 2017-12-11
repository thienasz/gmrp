<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ForgotPasswordService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\PayloadFactory;

class ForgotPasswordController extends Controller
{
    private $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function checkMail(Request $request){
        //Validate
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(["Error"=>$validator->errors()]);
        }

        //Check user from table User, if user haven't register, return Message
        $user = $this->forgotPasswordService->getUserByEmail($request->email);

        if ($user){
            //Check if user changed password before. If not, create new object Password Reset,
            //if they changed before, return token from table Password Reset.
            $token = $this->forgotPasswordService->createPasswordReset($request->email);

            if (!$token){
                return response()->json(["Message"=>"Failed to create Password Reset"]);
            }

            //Send mail to User.
            $sendmail = $this->forgotPasswordService->sendEmail($user,$token);

            return response()->json(["Message"=>"Create Password Reset Successfully."]);
        }

//        return response()->json(["Message"=>"Email not found."]);
        return $user;
    }

    public function getUserEmail($token){
        $email = $this->forgotPasswordService->getEmailFromToken($token);

        return response()->json(["email"=>$email]);
    }

    public function resetPassword(Request $request){
        //Validation
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(["Error"=>$validator->errors()]);
        }

        //Update User password
        $userUpdated = $this->forgotPasswordService->updatePassword($request);
        if (!$userUpdated)
            return response()->json(["Message"=>"Error"]);

        //Reset password_resets's token
        $tokenReset = $this->forgotPasswordService->resetPassword($request->email);
        if (!$userUpdated)
            return response()->json(["Message"=>"Error"]);

        return response()->json(["Message"=>"Update Successfully"]);

    }
}
