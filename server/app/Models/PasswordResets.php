<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';

    protected $fillable = [
        'email','token','created_at'
    ];

    public function passwordResetModel(){
        $passwordResetModel = new PasswordResets();
        return $passwordResetModel;
    }

    public function getPasswordResetByEmail($email){

        $passwordReset = $this->passwordResetModel()->where('email',$email)->first();

        return $passwordReset;
    }

    public function updateToken($email,$token){
        $passwordReset = $this->passwordResetModel()
            ->where('email',$email)
            ->update(['token'=>$token]);

        return $passwordReset;
    }

    public function createPasswordReset($email,$token){
        $passwordReset = $this->passwordResetModel()->create([
            'email' => $email,
            'token' => $token
        ]);

        return $passwordReset;
    }

    public function getEmailFromToken($token){
        $email = $this->passwordResetModel()->where('token',$token)->value('email');

        return $email;
    }

    public function resetToken($email, $token){
        $tokenChanged = $this->passwordResetModel()
            ->where('email',$email)
            ->update(['token'=>$token]);

        return $tokenChanged;
    }
}
