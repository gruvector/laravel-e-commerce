<?php

namespace Modules\Media\Http\Controllers\Admin;

class FileManagerController
{
    /**
     * Display a listing of the resource..
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request('type');

        return view('media::admin.file_manager.index', compact('type'));
    }
}
