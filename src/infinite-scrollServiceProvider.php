<?php

namespace MrShaneBarron\infinite-scroll;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\infinite-scroll\Livewire\infinite-scroll;
use MrShaneBarron\infinite-scroll\View\Components\infinite-scroll as Bladeinfinite-scroll;
use Livewire\Livewire;

class infinite-scrollServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-infinite-scroll.php', 'ld-infinite-scroll');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-infinite-scroll');

        Livewire::component('ld-infinite-scroll', infinite-scroll::class);

        $this->loadViewComponentsAs('ld', [
            Bladeinfinite-scroll::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-infinite-scroll.php' => config_path('ld-infinite-scroll.php'),
            ], 'ld-infinite-scroll-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-infinite-scroll'),
            ], 'ld-infinite-scroll-views');
        }
    }
}
