<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FlashMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $status, public string $message)
    {
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.flash-message');
    }
}
