<?php

namespace GustavoMorais\User\Infrastructure\Middlewares;

use Closure;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        print_r(json_encode(['in middleware']));echo "\n\n";exit;

        // return $next($request);
    }
}
