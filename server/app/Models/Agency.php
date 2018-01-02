<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Agency extends Model
{
    protected $table = 'agencies';

    protected $guarded= [];

    public function registers() {
        return $this->hasMany('App\Models\User', 'agency_id');
    }

    public function newRegisters() {
        return $this->hasMany('App\Models\NewRegisterTracker', 'agency_id');
    }

    public function payments() {
        return $this->hasMany('App\Models\Payment', 'agency_id');
    }

    public function games() {
        return $this->belongsToMany('App\Models\Game', 'game_agency', 'agency_id', 'game_id')->withPivot('percent_share');
    }
}
