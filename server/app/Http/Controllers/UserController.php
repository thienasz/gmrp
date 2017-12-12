<?php
/**
 * Created by PhpStorm.
 * User: NCCSoft
 * Date: 9/11/2017
 * Time: 1:54 PM
 */

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    private $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUser();

        return response()->jsonOk($users);
    }
}