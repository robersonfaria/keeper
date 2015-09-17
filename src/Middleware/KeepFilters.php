<?php

namespace Jakjr\Keeper\Middleware;

use Closure;

class KeepFilters
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $request->has('filter') ) {

            $keeper = \App::make('keeper');

            $keeper->keep( array_dot( $request->only(['filter']) ) );

        }

        return $next($request);
    }
}
