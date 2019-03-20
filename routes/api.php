<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/forgotPassword', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/logout', 'Auth\LoginController@logout');
Route::get('auth/refresh', 'Auth\LoginController@refresh');
Route::post('auth/register', 'Auth\RegisterController@register');
Route::post('auth/resendVerificationEmail', 'Auth\VerificationController@resend');
Route::post('auth/resetPassword', 'Auth\ResetPasswordController@reset');
Route::get('auth/user', 'Auth\LoginController@user');
Route::post('auth/verifyEmail/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
