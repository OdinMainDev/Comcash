<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        $csp = "default-src 'self'; " .
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://mc.yandex.ru; " .
        "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; " .
        "img-src 'self' data: https://comcash.io; " .
        "font-src 'self' https://cdn.jsdelivr.net; " .
        "connect-src 'self' https://comcash.io https://mc.yandex.ru; " .
        "frame-src 'self' https://www.youtube.com; " .
        "frame-ancestors 'self'; " .
        "form-action 'self'; " .
        "base-uri 'self'; " .
        "report-uri /csp-report;";

        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'no-referrer');

        return $response;
    }
}
