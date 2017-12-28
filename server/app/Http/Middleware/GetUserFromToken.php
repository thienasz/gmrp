<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Middleware;

use League\Flysystem\Exception;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class GetUserFromToken extends BaseMiddleware
{
    public function handle($request, \Closure $next)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            throw new Exception("Token not provider");
        }

        $user = $this->auth->authenticate($token);

        if (! $user) {
            throw new Exception("User not found");
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
