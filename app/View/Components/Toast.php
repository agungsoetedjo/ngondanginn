<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
    public $type;
    public $message;
    public $timer;

    /**
     * Create a new component instance.
     */
    public function __construct($type = null, $message = null, $timer = 3000)
    {
        $this->type = $type;
        $this->message = $message;
        $this->timer = $timer;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toast');
    }
}
