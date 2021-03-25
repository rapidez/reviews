<?php

namespace Rapidez\Review;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rapidez\Review\Models\Scopes\WithReviewScope;
use TorMorten\Eventy\Facades\Eventy;

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
        Eventy::addFilter('product.scopes', fn () => [WithReviewScope::class]);
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/review'),
        ], 'views');
    }
}
