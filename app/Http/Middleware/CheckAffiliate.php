<?php

namespace App\Http\Middleware;

use App\Models\AffiliateCampaign;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckAffiliate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $url = $request->path();
        
        if (str_contains($url, '/')) {
            return $next($request);
        }

        if(mb_strlen($url) != 32){
            return $next($request);
        }

        if ($request->cookie('aff_hash')) {
            return $next($request);
        }

        $check = AffiliateCampaign::where("hash", $url)->first();
        if(!$check) {
            return $next($request);
        }

        Cookie::queue('aff_hash', $check->id, 365 * 86400 * 60);
        return redirect('/');
    }
}
