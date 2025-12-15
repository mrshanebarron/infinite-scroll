<?php

namespace MrShaneBarron\InfiniteScroll;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\InfiniteScroll\Livewire\InfiniteScroll;
use MrShaneBarron\InfiniteScroll\View\Components\InfiniteScroll as BladeInfiniteScroll;

class InfiniteScrollServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-infinite-scroll.php', 'sb-infinite-scroll');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-infinite-scroll');

        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-infinite-scroll', InfiniteScroll::class);
        }

        $this->loadViewComponentsAs('ld', [
            BladeInfiniteScroll::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-infinite-scroll.php' => config_path('sb-infinite-scroll.php'),
            ], 'sb-infinite-scroll-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-infinite-scroll'),
            ], 'sb-infinite-scroll-views');
        }
    }
}
