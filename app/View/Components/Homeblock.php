<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Homeblock extends Component
{
    public $topics;

    public $posts;

    public $top;
    public function __construct($topics, $posts, $top)
    {
        $this->topics = $topics;
        $this->posts = $posts;
        $this->top = $top;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.homeblock');
    }
}
