<?php

namespace Modules\Menu\MegaMenu;

use Illuminate\Support\Facades\Cache;
use Modules\Menu\Entities\Menu as MenuModel;

class MegaMenu
{
    private $menuId;

    public function __construct($menuId)
    {
        $this->menuId = $menuId;
    }

    public function menus()
    {
        return Cache::tags(['mega_menu', 'menu_items', 'pages', 'categories'])
            ->rememberForever(md5("mega_menu.{$this->menuId}:" . locale()), function () {
                return $this->getMenus()->map(function ($menu) {
                    return new Menu($menu);
                });
            });
    }

    private function getMenus()
    {
        return MenuModel::for($this->menuId)->where('menu_id', $this->menuId);
    }
}
