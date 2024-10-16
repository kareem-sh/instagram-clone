<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            App::setLocale(auth()->user()->lang);
            App::setFallbackLocale(auth()->user()->lang);
        } elseif (session()->has('lang')) {
            $lang = session()->get('lang');
            App::setLocale($lang);
        }
        return $next($request);
    }
}
