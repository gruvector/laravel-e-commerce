<?php

namespace Modules\User\Http\ViewComposers;

class CurrentUserComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with('currentUser', auth()->user());
    }
}
