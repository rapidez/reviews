<?php

namespace Rapidez\Reviews;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rapidez\Reviews\Models\Scopes\WithReviewsScope;
use TorMorten\Eventy\Facades\Eventy;

class ReviewsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'reviews');

        Eventy::addFilter('product.scopes', fn () => [WithReviewsScope::class]);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/reviews'),
        ], 'views');
    }
}
