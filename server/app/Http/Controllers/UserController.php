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
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class UserController extends Controller
{
    private $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUser(15, $request->get('role'));

        return response()->jsonOk($users);
    }
}