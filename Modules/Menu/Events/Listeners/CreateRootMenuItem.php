<?php

namespace Modules\Menu\Events\Listeners;

use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;

class CreateRootMenuItem
{
    /**
     * Handle the event.
     *
     * @param \Modules\Menu\Entities\Menu $menu
     * @return void
     */
    public function handle(Menu $menu)
    {
        $data = [
            'menu_id' => $menu->id,
            'type' => 'URL',
            'target' => '_self',
            'position' => 0,
            'is_root' => true,
            'is_fluid' => false,
            'is_active' => true,
        ];

        foreach (supported_locales() as $locale => $language) {
            $data[$locale]['name'] = 'root';
        }

        MenuItem::create($data);
    }
}
