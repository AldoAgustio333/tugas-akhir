<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearSessionErrors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Clear session errors for specific routes that should start fresh
        if (in_array($request->route()->getName(), [
            'dashboard',
            'user.dashboard', 
            'user.jbi.index',
            'riwayat.index'
        ])) {
            // Only clear if the request is GET (viewing page, not submitting form)
            if ($request->isMethod('GET')) {
                session()->forget(['errors']);
            }
        }

        return $next($request);
    }
}