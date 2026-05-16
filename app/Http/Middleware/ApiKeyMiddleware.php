<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     * Memvalidasi API Key dari header X-IAE-KEY sesuai Standard Integration Contract.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-IAE-KEY');

        if (empty($apiKey) || $apiKey !== config('app.api_key')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. API Key (X-IAE-KEY) tidak valid atau tidak ditemukan.',
                'errors' => null,
            ], 401);
        }

        return $next($request);
    }
}
