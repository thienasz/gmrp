<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailsController extends Controller
{
    private $userdetailsModel;

    public function __construct(UserDetails $userdetailsModel)
    {
        $this->userdetailsModel = $userdetailsModel;
    }

    public function index(){
        //Get user credentials
        $user = Auth::user();
        $userID = $user->id;

        //Get user details
        $userDetails = $this->userdetailsModel->getUserDetailsByID($userID);

        return response()->json(["user"=>$user,"user_details"=>$userDetails]);
    }

    public function update(Request $request){
        $user = Auth::user();
        $userID = $user->id;

        //Update
        $updateResult = $this->userdetailsModel->updateUserDetails($userID,$request);

        if ($updateResult){
            $userDetails = $this->userdetailsModel->getUserDetailsByID($userID);
            return response()->json(["Message"=>"Update Successfully", "data"=>$userDetails]);
        }else{
            return response()->json(["Message"=>"Error."]);
        }

    }
}
