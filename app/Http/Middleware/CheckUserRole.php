<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Check if user is logged in and their role matches allowed roles
        if ($user && in_array($user->usertype, $roles)) {
            return $next($request);
        }

        // Redirect to a default route if the role doesn't match
        return redirect()->route('login')->withErrors(['access_denied' => 'Unauthorized access!']);
    }
}
