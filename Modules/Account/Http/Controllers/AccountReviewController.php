<?php

namespace Modules\Account\Http\Controllers;

class AccountReviewController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = auth()->user()
            ->reviews()
            ->withoutGlobalScope('approved')
            ->with('product.files')
            ->whereHas('product')
            ->paginate(20);

        return view('public.account.reviews.index', compact('reviews'));
    }
}
