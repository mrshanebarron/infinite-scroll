<?php

namespace MrShaneBarron\infinite-scroll\View\Components;

use Illuminate\View\Component;

class infinite-scroll extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-infinite-scroll::components.infinite-scroll');
    }
}
