<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSidebar extends Component
{
    public $activeModule, $activePage;
    /**
     * Create a new component instance.
     */
    public function __construct($activeModule, $activePage)
    {
        $this->activeModule = $activeModule;
        $this->activePage = $activePage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-sidebar');
    }
}
