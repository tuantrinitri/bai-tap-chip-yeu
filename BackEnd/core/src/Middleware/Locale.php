<?php

namespace Core\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('admin-locale') === null) {
            session()->put('admin-locale', 'vi');
        }
        if ($request->route()->getPrefix() === 'file-manager' && session('admin-locale') === 'vi') {
            app()->setLocale('ar');
        } else {
            app()->setLocale(session('admin-locale'));
        }
        return $next($request);
    }
}