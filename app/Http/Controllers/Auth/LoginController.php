<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    /**
     * Attempt to log the user in.
     *
     * @param  Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return (bool) $this->guard()->attempt($this->credentials($request));
    }

    /**
     * Get the response after the user was authenticated.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return jsend_success($this->getJwtData());
    }

    /**
     * Get the failed login response.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return jsend_fail([
            'email' => [trans('auth.failed')]
        ], 422);
    }

    /**
     * Log the user out of the application.
     *
     * @return JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return jsend_success();
    }

    /**
     * Get the authenticated User.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function user(Request $request)
    {
        return jsend_success(new UserResource($request->user()));
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        $this->guard()->setToken($this->guard()->refresh());

        return jsend_success($this->getJwtData());
    }

    /**
     * Generate the token data for the currently logged in user.
     *
     * @return array
     */
    protected function getJwtData()
    {
        $token = (string) $this->guard()->getToken();
        $expiration = $this->guard()->factory()->getTTL() * 60;

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiration,
        ];
    }
}
