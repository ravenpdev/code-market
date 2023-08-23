<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUserHasNotEnabledStripe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if user has enabled stripe account
        // if not redirect to onboarding page
        if ($request->user() && !$request->user()->stripe_account_enabled) {
            return to_route('onboarding');
        }

        return $next($request);
    }
}
