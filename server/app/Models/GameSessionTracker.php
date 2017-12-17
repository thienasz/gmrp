<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GameSessionTracker extends Model
{
    protected $table = 'game_session_tracker';

    protected $guarded= [];
}
