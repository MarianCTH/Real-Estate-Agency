<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'Agent imobiliar') {
            return $next($request);
        }

        return redirect()->route('welcome')->with('error', 'Nu ai permisiunea de a accesa această pagină.');
    }
}
