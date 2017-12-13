<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password','role', 'game_id'
//    ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    public function getUserByEmail($userEmail){
        $user = $this->where('email',$userEmail)
            ->first();

        return $user;
    }

    public function updateUserPassword($email,$password){
        $userUpdated = $this->where('email',$email)
            ->update(['password'=>bcrypt($password)]);

        return $userUpdated;
    }
}
