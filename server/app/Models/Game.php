<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Game extends Model
{
    protected $table = 'games';

    protected $guarded= [];

    public function newRegisters() {
        return $this->hasMany('App\Models\NewRegisterTracker', 'game_id');
    }

    public function registers() {
        return $this->hasMany('App\Models\User', 'game_id');
    }
}
