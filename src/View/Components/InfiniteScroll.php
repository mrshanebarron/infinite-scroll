<?php

namespace MrShaneBarron\InfiniteScroll\View\Components;

use Illuminate\View\Component;

class InfiniteScroll extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('sb-infinite-scroll::components.infinite-scroll');
    }
}
