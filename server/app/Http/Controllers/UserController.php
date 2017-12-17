<?php
/**
 * Created by PhpStorm.
 * User: NCCSoft
 * Date: 9/11/2017
 * Time: 1:54 PM
 */

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class UserController extends Controller
{
    private $userService;
    private $paymentService;

    function __construct(UserService $userService, PaymentService $paymentService)
    {
        $this->userService = $userService;
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUser(15, $request->get('role'));

        return response()->jsonOk($users);
    }

    public function pay(Request $request)
    {
        $this->validate($request, [
            'pay_price'=>'required',
            'pay_card_type'=>'required',
        ], [
            'pay_price'=>'required',
            'pay_card_type'=>'required',
        ]);

        $users = $this->paymentService->pay($request);

        return response()->jsonOk($users);
    }
}