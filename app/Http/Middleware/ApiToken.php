<?php

namespace App\Http\Middleware;

use Closure;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 */
class ApiToken
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
        $apiKey  = $request->header('API_KEY');
        if($apiKey === "API_DEMO")
            return $next($request);
        return response()->json(['error' => 'No API key found in request'], 401);
    }
}
