<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('lang') ?: $request->query('locale');

        if ($locale && in_array($locale, ['en', 'fr', 'ar'])) {
            session(['locale' => $locale]);
            session()->save();
            \Illuminate\Support\Facades\App::setLocale($locale);
        } elseif (session()->has('locale')) {
            $savedLocale = session()->get('locale');
            if (in_array($savedLocale, ['en', 'fr', 'ar'])) {
                \Illuminate\Support\Facades\App::setLocale($savedLocale);
            }
        }

        return $next($request);
    }
}
