<?php

namespace App\Http\View\Composers;

use App\Models\NavigationMenu;
use Illuminate\View\View;

class NavigationMenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        // Get published top-level parents with their published children
        $navigationMenus = NavigationMenu::whereNull('parent_id')
            ->where('status', 'published')
            ->with('publishedChildren')
            ->orderBy('sort_order')
            ->get();

        $view->with('navigationMenus', $navigationMenus);
    }
}
