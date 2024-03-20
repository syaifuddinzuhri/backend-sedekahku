<?php

namespace App\Http\Middleware;

use App\Traits\GlobalTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;

class JwtMiddleware
{
    use GlobalTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        try {
            if (auth($guard)->guest()) {
                return $this->customResponse(false, 'Unautorized', [], 401);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->customResponse(false, 'Token is Invalid!', [], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->customResponse(false, 'Token is Expired!', [], 401);
            } else {
                return $this->customResponse(false, 'Unautorized', [], 401);
            }
        }
        return $next($request);
    }
}
