<?php

namespace App\Http\Middleware;

use App\Traits\GeneralFuncions;
use Closure;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateJWT
{
    use GeneralFuncions;

    private $JWTAuth;

    public function __construct(
        JWTAuth $JWTAuth
    )
    {
        $this->JWTAuth = $JWTAuth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->bearerToken()) {
            return new JsonResponse(
                $this->getApiReturn(false, 'Bearer token not found', null),
                Response::HTTP_UNAUTHORIZED
            );
        }

        $token = $this->JWTAuth->parseToken()->check();

        if (! $token == true) {
            return new JsonResponse(
                $this->getApiReturn(false, 'Unauthorized', null),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $next($request);
    }
}
