<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requiredSessionKeys = [
            'ADMIN_LOGIN',
            'ADMIN_ID',
            'ADMIN_NAME',
            'ADMIN_EMAIL',
            'ADMIN_PROFILE',
            'IS_ADMIN',
        ];

        foreach ($requiredSessionKeys as $key) {
            if (!$request->session()->has($key)) {
                return redirect()->route('admin.login')->with('error', 'Access Denied - Session expired or incomplete');
            }
        }

        // Optional: Validate 'IS_ADMIN' value
        if (!$request->session()->get('IS_ADMIN')) {
            return redirect()->route('admin.login')->with('error', 'Access Denied - Not an admin');
        }

        return $next($request);
    }
}
