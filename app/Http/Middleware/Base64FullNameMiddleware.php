<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Base64FullNameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::channel('stderr')->info('Middleware for Base64FullName');
        try {
            if ($request->header('Authorization')) {
                $token = str_replace("Bearer ", "", $request->header('Authorization'));

                $decodedFullName = base64_decode($token, true);
                if ($decodedFullName === false) {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }

                $user = User::where('name', $decodedFullName)->first();
                if (!$user) {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }

                $request->merge(['user_id' => $user->id]);
                return $next($request);
            }
            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            // Log the exception and return a custom error response
            \Log::channel('stderr')->error('Middleware for Base64FullName: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}
