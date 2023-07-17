<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin // extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        Log::debug('handle not admin');
        // return redirect(RouteServiceProvider::HOME);

        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        return $next($request);
    }

    protected function redirectTo(Request $request): ?string
    {   
        return route('dashboard');
        $data = $request->expectsJson();
        $user = Auth::user();
        Log::debug($data);
        Log::debug($user);
        return $user["is_admin"] ? null : route('login');
        // return $request->expectsJson() ? null : route('login');
    }
}
