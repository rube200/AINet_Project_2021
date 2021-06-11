<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BlockedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user)
            return $next($request);

        if ($user->bloqueado)
        {
            Auth::logout();
            //todo add account suspense msg
            return redirect()->route('login');
        }

        switch ($request->url())
        {
            /* exclude basic auth stuff to not loop */
            case route('logout'):
            case route('verification.notice'):
            case route('verification.resend'):
                return $next($request);
        }

        if (str_starts_with(strtolower($request->path()), 'email/verify'))
            return $next($request);

        if ($user instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
