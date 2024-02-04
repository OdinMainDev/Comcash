<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JoeDixon\Translation\TranslationServiceProvider;

class OctaneTranslationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        app()->resolving(TranslationServiceProvider::class, function ($translator) {
            $translator->registerProvider(TranslationServiceProvider::class);
        });
        return $next($request);
    }
}
