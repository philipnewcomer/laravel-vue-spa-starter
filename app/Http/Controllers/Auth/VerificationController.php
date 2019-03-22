<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException();
        }

        $request->query->set('expires', $request->json('expires'));
        $request->query->set('signature', $request->json('signature'));

        if (! URL::hasValidSignature($request)) {
            return jsend_fail(['message' => 'Invalid signature.']);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return jsend_fail(['message' => 'Your email has already been verified.']);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return jsend_success();
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return jsend_fail(['message' => 'Your email has already been verified.']);
        }

        $request->user()->sendEmailVerificationNotification();

        return jsend_success();
    }
}
