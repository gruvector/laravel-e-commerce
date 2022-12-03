<?php

namespace Modules\Wishlist\Http\Controllers;

class WishlistProductController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()
            ->wishlist()
            ->with('files')
            ->latest()
            ->paginate(20);
    }
}
