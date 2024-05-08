<?php

namespace App\Http\Controllers\ClinicianAuth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('clinician')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::CLINITIAN_HOME);
        }

        $request->user('clinician')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
