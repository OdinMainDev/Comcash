<?php

namespace App\Http\Middleware;

use App\Models\UtmParameter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class CheckUtm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $utmParameters = [
            'utm_source' => $this->checkAndTruncate($request->query('utm_source')),
            'utm_medium' => $this->checkAndTruncate($request->query('utm_medium')),
            'utm_campaign' => $this->checkAndTruncate($request->query('utm_campaign')),
            'utm_term' => $this->checkAndTruncate($request->query('utm_term')),
            'utm_content' => $this->checkAndTruncate($request->query('utm_content'))
        ];

        if (array_filter($utmParameters)) {
            $utm = UtmParameter::firstOrCreate($utmParameters);
            Cookie::queue('utm_hash', $utm->id, 86400);
        }

        return $next($request);
    }

    private function checkAndTruncate($value, $limit = 255)
    {
        if (is_string($value) && strlen($value) >= $limit) {
            return null;
        }

        return $value;
    }
}
