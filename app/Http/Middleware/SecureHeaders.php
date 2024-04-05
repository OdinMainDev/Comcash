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
        
        $csp = [
            "default-src" => "'self'",
            "script-src" => [
                "'report-sample'",
                "'self'",
                "https://code.jivosite.com/",
                "https://prostor-lite.ru/gtm/",
                "https://www.google-analytics.com/analytics.js",
                "https://www.googletagmanager.com/gtm.js",
                "https://code.jivosite.com/js/bundle_ru_RU.js",
                "https://mc.yandex.ru/metrika/tag.js"
            ],
            "style-src" => [
                "'report-sample'",
                "'self'",
                "http://code.jivosite.com",
                "https://cdn.jsdelivr.net",
                "https://cdnjs.cloudflare.com",
                "https://code.jivosite.com",
                "https://fonts.googleapis.com"
            ],
            "object-src" => "'none'",
            "base-uri" => "'self'",
            "connect-src" => [
                "'self'",
                "https://code.jivosite.com",
                "https://mc.yandex.com",
                "https://node-ya-5.jivosite.com",
                "https://telemetry.jivosite.com",
                "https://www.google-analytics.com"
            ],
            "font-src" => [
                "'self'",
                "data:",
                "https://fonts.gstatic.com"
            ],
            "frame-src" => [
                "'self'",
                "https://mc.yandex.com"
            ],
            "img-src" => [
                "'self'",
                "http://www.google-analytics.com",
                "https://antiswap.info",
                "https://mc.yandex.com",
                "https://www.okchanger.ru"
            ],
            "manifest-src" => "'self'",
            "media-src" => [
                "'self'",
                "https://code.jivosite.com"
            ],
            "worker-src" => "'none'",
        ];

        $cspString = [];
        foreach ($csp as $directive => $sources) {
            if (is_array($sources)) {
                $cspString[] = $directive . ' ' . implode(' ', $sources);
            } else {
                $cspString[] = $directive . ' ' . $sources;
            }
        }
        
        if (!$request->is('*/panel/*') && !$request->is('*/panel')) {
            // $response->headers->set('Content-Security-Policy', implode('; ', $cspString));
        }
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'no-referrer');

        return $response;
    }
}
