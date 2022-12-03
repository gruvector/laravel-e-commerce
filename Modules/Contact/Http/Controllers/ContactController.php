<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Modules\Contact\Http\Requests\ContactRequest;

class ContactController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        Mail::raw($request->message, function (Message $message) use ($request) {
            $message->subject($request->subject)
                ->replyTo($request->email)
                ->to(setting('store_email'));
        });

        return back()->with('success', trans('contact::messages.your_message_has_been_sent'));
    }
}
