<?php

namespace Rapidez\Reviews;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rapidez\Reviews\Models\Scopes\WithReviewsScope;
use TorMorten\Eventy\Facades\Eventy;

class ReviewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rapidez-reviews');

        Eventy::addFilter('product.scopes', fn () => [WithReviewsScope::class]);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/rapidez-reviews'),
        ], 'views');
    }
}
