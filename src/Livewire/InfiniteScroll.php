<?php

namespace MrShaneBarron\InfiniteScroll\Livewire;

use Livewire\Component;

class InfiniteScroll extends Component
{
    public array $items = [];
    public int $perPage = 10;
    public int $page = 1;
    public bool $hasMore = true;
    public bool $loading = false;

    public function mount(
        array $items = [],
        int $perPage = 10
    ): void {
        $this->items = $items;
        $this->perPage = $perPage;
    }

    public function loadMore(): void
    {
        if (!$this->hasMore || $this->loading) return;
        
        $this->loading = true;
        $this->page++;
        $this->dispatch('load-more', page: $this->page, perPage: $this->perPage);
    }

    public function appendItems(array $newItems): void
    {
        $this->items = array_merge($this->items, $newItems);
        $this->hasMore = count($newItems) === $this->perPage;
        $this->loading = false;
    }

    public function render()
    {
        return view('sb-infinite-scroll::livewire.infinite-scroll');
    }
}
