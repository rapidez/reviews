<?php

namespace Rapidez\Reviews;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use Rapidez\Reviews\Models\Scopes\WithReviewsScope;
use TorMorten\Eventy\Facades\Eventy;

class ReviewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rapidez-reviews');

        Eventy::addFilter('product.scopes', fn ($scopes) => array_merge($scopes ?: [], [WithReviewsScope::class]));

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/rapidez-reviews'),
        ], 'views');
    }

    public function register()
    {
        $this
            ->registerBladeIconConfig();
    }

    protected function registerBladeIconConfig(): self
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('rapidez::reviews', [
                'path'   => __DIR__.'/../resources/svg',
                'prefix' => 'rapidez::reviews',
            ]);
        });

        return $this;
    }
}
