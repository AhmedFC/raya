<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class ActiveUser
{
    public function handle($request, Closure $next)
    {
       // dd($request->header('Authorization'));
        if ($request->header('Authorization')) {
            $token = str_replace('Bearer ', '', $request->header('Authorization'));

            $user = User::where('api_token',  $token)->first();

            if ($user && $user->status == "0") {
                return response()->json(['message' => 'User not activate please contact admin'], 400);
            }

            return $next($request);
        }

        return response()->json(['message' => 'No authorized .'], 400);
    }
}
