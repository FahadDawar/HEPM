<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // check for admin guard
        if($request->routeIs('admin.*')){
            return route('admin.login');
        }

        //check for clinician guard
        if($request->routeIs('clinician.*')){
            return route('clinician.login');
        }
        
        return $request->expectsJson() ? null : route('login');
    }
}
