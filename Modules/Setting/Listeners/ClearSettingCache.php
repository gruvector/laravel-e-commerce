<?php

namespace Modules\Setting\Listeners;

use Illuminate\Support\Facades\Cache;

class ClearSettingCache
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        foreach (supported_locale_keys() as $locale) {
            Cache::forget(md5('settings.all:' . $locale));
        }
    }
}
