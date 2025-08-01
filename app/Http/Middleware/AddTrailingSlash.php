<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddTrailingSlash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() == 'GET') {
            if (strpos(url()->full(), config('app.admin_dir')) != true) {
                if (strpos(url()->full(), "?") != false || strpos(url()->full(), ".xml") != false) {
                    return $next($request);
                }
                $base_url = url('/');
                if ($request->getRequestUri() !="/" && ( !preg_match('/.+\/$/', $request->getRequestUri()))) {
                    $new_url = str_replace(".html", "",rtrim($base_url.$request->getRequestUri(), '/'));
                    return Redirect::to($new_url.'/', 301);
                }
            }
        }
        return $next($request);
    }
}
