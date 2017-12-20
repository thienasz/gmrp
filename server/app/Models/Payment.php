<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Payment extends Model
{
    protected $table = 'payments';

    protected $guarded= [];

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }

    public function paymentType()
    {
        return $this->hasOne('App\Models\PaymentType', 'id', 'pay_card_type');
    }
}
