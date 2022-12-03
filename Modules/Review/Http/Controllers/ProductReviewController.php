<?php

namespace Modules\Review\Http\Controllers;

use Modules\Review\Entities\Review;
use Modules\Product\Entities\Product;
use Modules\Review\Http\Requests\StoreReviewRequest;

class ProductReviewController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function index($productId)
    {
        return Review::where('product_id', $productId)->latest()->paginate(4);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $productId
     * @param \Modules\Review\Http\Requests\StoreReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($productId, StoreReviewRequest $request)
    {
        if (! setting('reviews_enabled')) {
            return;
        }

        return Product::findOrFail($productId)
            ->reviews()
            ->create([
                'reviewer_id' => auth()->id(),
                'rating' => $request->rating,
                'reviewer_name' => $request->reviewer_name,
                'comment' => $request->comment,
                'is_approved' => setting('auto_approve_reviews', 0),
            ]);
    }
}
