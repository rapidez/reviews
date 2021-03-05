<?php

namespace Rapidez\Review;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'review');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/review'),
        ], 'views');
    }
}
