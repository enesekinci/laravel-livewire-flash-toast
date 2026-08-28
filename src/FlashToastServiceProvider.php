<?php

namespace EnesEkinci\FlashToast;

use EnesEkinci\FlashToast\Livewire\ToastHost;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FlashToastServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'flash-toast');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'flash-toast');

        Livewire::component('flash-toast', ToastHost::class);
        Livewire::component('toast-host', ToastHost::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/flash-toast'),
            ], 'flash-toast-views');

            $this->publishes([
                __DIR__.'/../lang' => lang_path('vendor/flash-toast'),
            ], 'flash-toast-lang');
        }
    }
}
