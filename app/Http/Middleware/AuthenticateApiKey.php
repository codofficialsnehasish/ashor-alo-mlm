<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthenticateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('Authorization');

        if (!$apiKey) {
            return response()->json(['error' => 'API key is missing.'], 401);
        }

        $apiKey = str_replace('Bearer ', '', $apiKey);
        $apiKeyModel = User::where('api_access_key', $apiKey)->first();

        if (!$apiKeyModel) {
            return response()->json(['error' => 'Invalid API key.'], 401);
        }

        // Optionally, you can attach the authenticated user to the request
        // $request->user = $apiKeyModel->user;

        return $next($request);
    }
}
