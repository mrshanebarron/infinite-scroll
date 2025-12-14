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
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-infinite-scroll.php', 'sb-infinite-scroll');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-infinite-scroll');

        Livewire::component('sb-infinite-scroll', infinite-scroll::class);

        $this->loadViewComponentsAs('ld', [
            Bladeinfinite-scroll::class,
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
