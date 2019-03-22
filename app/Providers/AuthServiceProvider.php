<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage())
                ->subject(Lang::getFromJson('Reset Password Notification'))
                ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
                ->action(Lang::getFromJson('Reset Password'), sprintf('%s/resetPassword/%s?email=%s', config('app.url'), $token, urlencode($notifiable->email)))
                ->line(Lang::getFromJson('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
                ->line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));
        });

        VerifyEmail::toMailUsing(function ($notifiable) {
            $apiVerificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(config('auth.verification.expire', 60)),
                ['id' => $notifiable->getKey()]
            );

            $emailVerificationUrl = str_replace(
                route('verification.verify', $notifiable->getKey()),
                url('/verifyEmail'),
                $apiVerificationUrl
            );

            return (new MailMessage())
                ->subject(Lang::getFromJson('Verify Email Address'))
                ->line(Lang::getFromJson('Please click the button below to verify your email address.'))
                ->action(Lang::getFromJson('Verify Email Address'), $emailVerificationUrl)
                ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));
        });
    }
}
