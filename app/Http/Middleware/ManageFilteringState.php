<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageFilteringState
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->named('tasks.index.all')) {

            session(['filter' => 'all', 'search' => null]);

        } elseif ($request->route()->named('tasks.index.completed')) {

            session(['filter' => 'completed', 'search' => null]);

        } else if ($request->route()->named('tasks.index.search')) {

            session(['filter' => null, 'search' => $request->input('term')]);

        } else if ($request->route()->named('tasks.index')) {

            session(['filter' => null, 'search' => null]);

        }
        return $next($request);
    }
}
