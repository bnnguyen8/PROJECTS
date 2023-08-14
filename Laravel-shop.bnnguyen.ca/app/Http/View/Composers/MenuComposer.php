<?php


namespace App\Http\View\Composers;
use App\Models\Menu;
use Illuminate\View\View;
use App\Http\Services\Menu\MenuService;

// https://laravel.com/docs/10.x/views#view-composers
class MenuComposer
{
    protected $users;
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function compose(View $view)
    {
        $view->with('menuFooter', $this->menuService->getAll());
    }
}
