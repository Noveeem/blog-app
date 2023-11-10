<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class app extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.app');
    }
}
