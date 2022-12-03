<?php

namespace Modules\Product\Filters;

use Illuminate\Http\Request;

class ProductFilter
{
    private $request;
    private $queryStringFilter;

    public function __construct(Request $request, QueryStringFilter $queryStringFilter)
    {
        $this->request = $request;
        $this->queryStringFilter = $queryStringFilter;
    }

    public function apply($query)
    {
        $query = $query->forCard();

        foreach ($this->filters() as $name => $value) {
            if (! is_null($value)) {
                $this->queryStringFilter->{$name}($query, $value);
            }
        }

        return $query;
    }

    private function filters()
    {
        return array_filter($this->request->query(), function ($filter) {
            return $this->filterExists($filter);
        }, ARRAY_FILTER_USE_KEY);
    }

    private function filterExists($filter)
    {
        return method_exists($this->queryStringFilter, $filter) &&
            is_callable([$this->queryStringFilter, $filter]);
    }
}
