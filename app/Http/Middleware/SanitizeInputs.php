<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInputs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $inputs = $request->all();
        foreach($inputs as $key => $value) {
            $inputs[$key] = strip_tags($value);
        }  
        
        $request->merge($inputs);

        return $next($request);
    }
}
