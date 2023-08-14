<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{

    /**
     * Get the Access Token cookie of request and if it was valid, corresponding user added to request
     * @param $request
     * @param Closure $next
     * @param ...$guards
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response|mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $accessToken = $request->cookie('access_token');
        if ($accessToken) {
            $user = Auth::getProvider()->retrieveByCredentials(['remember_token' => $accessToken]);
            if ($user) {
                $request->user = $user;
                return $next($request);
            }
        }
        return response('Not Authenticated', 401);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
