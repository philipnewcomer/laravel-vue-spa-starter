<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return jsend_success();
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return jsend_fail([
            'email' => [trans($response)]
        ]);
    }
}
