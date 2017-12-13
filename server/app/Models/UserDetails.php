<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserDetails extends Model
{
    protected $table = 'user_details';

//    protected $fillable = [
//        'firstname','lastname','date_of_birth','phone','cityID','districtID','address','userID','status','gender'
//    ];

    protected $guarded = [];
    public function getUserDetailsByID($userID){
        $userDetailsModel = new UserDetails();

        $userDetail = $userDetailsModel->where('userID',$userID)->first();

        return $userDetail;
    }

    public function updateUserDetails($userID, Request $request){
        $userDetailsModel = new UserDetails();

        $updateResult = $userDetailsModel
            ->where('userID',$userID)
            ->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'date_of_birth' => $request->date_of_birth,
                'gender' =>$request->gender,
                'phone' => $request->phone,
                'cityID' => $request->cityID,
                'districtID' => $request->districtID,
                'address' => $request->address
            ]);

        return $updateResult;
    }
}
