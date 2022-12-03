<?php

namespace Modules\Page\Http\Controllers;

use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;

class PageController
{
    /**
     * Display page for the slug.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $logo = File::findOrNew(setting('storefront_header_logo'))->path;
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('public.pages.show', compact('page', 'logo'));
    }
}
