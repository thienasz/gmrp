<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class PaymentService extends Service{
    private $payment;

    public function __construct(
        Payment $payment
    )
    {
        $this->payment = $payment;
    }

    public function pay(Request $request){
        $data = $request->only([
            'description',
            'pay_price',
            'pay_card_type'
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['agency_id'] = Auth::user()->agency_id;
        $data['game_id'] = Auth::user()->game_id;
        return $this->payment->create($data);
    }
}