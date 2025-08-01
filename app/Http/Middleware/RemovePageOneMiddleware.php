<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemovePageOneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the query parameters
        $queryParams = $request->query();

        // Check if 'page' parameter is present and equal to 0
        if (isset($queryParams['page']) && $queryParams['page'] == 1) {
            // If there are other query parameters, remove only 'page=0'
            if (count($queryParams) > 1) {
                unset($queryParams['page']);
                $queryString = http_build_query($queryParams);
                // Rebuild the URL without 'page=0'
                return redirect($request->url() . '?' . $queryString);
            } else {
                // If 'page=0' is the only parameter, remove the entire query string
                return redirect($request->url());
            }
        }

        return $next($request);
    }
}
