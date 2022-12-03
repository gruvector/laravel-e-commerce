<?php

namespace Modules\Category\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class CategoryTreeResponse implements Responsable
{
    /**
     * Categories collection.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $categories;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Database\Eloquent\Collection $categories
     */
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json($this->transform());
    }

    /**
     * Transform the categories.
     *
     * @return \Illuminate\Support\Collection
     */
    private function transform()
    {
        return $this->categories->map(function ($category) {
            return [
                'id' => $category->id,
                'parent' => $category->parent_id ?: '#',
                'text' => $category->name,
                'data' => [
                    'position' => $category->position,
                ],
            ];
        });
    }
}
