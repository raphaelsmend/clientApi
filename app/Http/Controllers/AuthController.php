<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\GeneralFuncions;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use GeneralFuncions;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return new JsonResponse(
                $this->getApiReturn(false, 'Unauthorized', null),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return new JsonResponse(
            $this->getApiReturn(false, 'Unauthorized', auth('api')->user()),
            Response::HTTP_OK
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return new JsonResponse(
            $this->getApiReturn(true, 'Successfully logged out', auth('api')->user()),
            Response::HTTP_OK
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return new JsonResponse(
            $this->getApiReturn(true, null, $this->respondWithToken(auth('api')->refresh())),
            Response::HTTP_OK
        );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return new JsonResponse(
            $this->getApiReturn(true, null, [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => 3600
            ]),
            Response::HTTP_OK
        );
    }
}
