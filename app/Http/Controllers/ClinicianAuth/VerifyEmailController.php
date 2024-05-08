<?php

namespace App\Http\Controllers\ClinicianAuth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('clinician')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::CLINITIAN_HOME.'?verified=1');
        }

        if ($request->user('clinician')->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::CLINITIAN_HOME.'?verified=1');
    }
}
