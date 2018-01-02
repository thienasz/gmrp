<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GameAgency extends Model
{
    protected $table = 'game_agency';

    protected $guarded= [];
    public $timestamps = true;

    public function syncGame($games, Agency $agency)
    {
        $data = [];
        foreach ($games as $game) {
            $data[$game['game_id']] = [
                'percent_share' => $game['percent_share'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        //delete
        $agency->games()->sync($data);

        return $agency; //->with(['games'])->first();
    }
}
