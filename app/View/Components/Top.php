<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Top extends Component
{
    public $top;

    public function __construct($top)
    {
        $this->top = $top;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.top');
    }
}
