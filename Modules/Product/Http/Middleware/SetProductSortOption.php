<?php

namespace Modules\Product\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetProductSortOption
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldSetRelevanceSortOption($request)) {
            $request->query->set('sort', 'relevance');
        }

        if ($this->shouldSetLatestSortOption($request)) {
            $request->query->set('sort', 'latest');
        }

        return $next($request);
    }

    /**
     * Determine if the request should set "relevance" sort option.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function shouldSetRelevanceSortOption($request)
    {
        return $request->has('query') && ! $request->has('sort');
    }

    /**
     * Determine if the request should set "latest" sort option.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function shouldSetLatestSortOption($request)
    {
        return ! $request->has('query') && ! $request->has('sort');
    }
}
