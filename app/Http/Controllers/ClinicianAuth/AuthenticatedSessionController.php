<?php

namespace App\Http\Controllers\ClinicianAuth;

use App\Models\Clinician;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\ClinicianLoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('clinicians.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(ClinicianLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // if auth success update is_online
        $id = Auth::guard('clinician')->id();
        Clinician::find($id)->update(['is_online' => 1]);

        return redirect()->intended(RouteServiceProvider::CLINITIAN_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        auth()->user()->update(['is_online' => 0]);
        Auth::guard('clinician')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/clinician/login');
    }
}
