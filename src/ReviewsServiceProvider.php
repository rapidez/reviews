<?php

namespace Rapidez\Reviews;

use BladeUI\Icons\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Rapidez\Core\Models\Product;
use Rapidez\Reviews\Models\RatingOptionVote;
use Rapidez\Reviews\Models\Review;
use Rapidez\Reviews\Models\Scopes\WithReviewsScope;
use TorMorten\Eventy\Facades\Eventy;

class ReviewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rapidez-reviews');

        Eventy::addFilter('product.scopes', fn ($scopes) => array_merge($scopes ?: [], [WithReviewsScope::class]));
        Eventy::addFilter('productpage.frontend.attributes', fn ($attributes) => array_merge($attributes ?: [], ['reviews_score']));

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/rapidez-reviews'),
        ], 'views');

        config('rapidez.models.product')::resolveRelationUsing('reviews', function (Product $product) {
            return $product->hasMany(Review::class, 'entity_pk_value', 'entity_id');
        });

        config('rapidez.models.product')::macro('reviewCountPerPercent', function () {
            return Cache::store('array')->rememberForever('reviewsGroupedByAveragePercent:'.$this->getKey(), function () {
                $review = new Review;
                $ratingOptionVote = new RatingOptionVote;

                $reviewAverages = $review
                    ->newQuery()
                    ->selectRaw($review->qualifyColumn('review_id').', AVG('.$ratingOptionVote->qualifyColumn('percent').') as average_percent')
                    ->join(
                        $ratingOptionVote->getTable(),
                        $ratingOptionVote->qualifyColumn('review_id'),
                        '=',
                        $review->qualifyColumn('review_id')
                    )
                    ->where($review->qualifyColumn('entity_pk_value'), $this->getKey())
                    ->groupBy($review->qualifyColumn('review_id'));

                return DB::query()
                    ->fromSub($reviewAverages->toBase(), 'review_averages')
                    ->selectRaw('average_percent, COUNT(*) as reviews_count')
                    ->groupBy('average_percent')
                    ->orderBy('average_percent')
                    ->pluck('reviews_count', 'average_percent')
                    ->mapWithKeys(fn ($reviewsCount, $averagePercent) => [$averagePercent + 0 => $reviewsCount]);
            });
        });

        config('rapidez.models.product')::macro('reviewCountPerStar', function (int $stars = 5) {
            $reviewsGroupedByAveragePercent = $this->reviewCountPerPercent();

            $reviewsCountPerStar = [];
            for ($i = 1; $i <= $stars; $i++) {
                $reviewsCountPerStar[$i] = 0;
                foreach ($reviewsGroupedByAveragePercent as $averagePercent => $reviewsCount) {
                    if (ceil($averagePercent / (100 / $stars)) == $i) {
                        $reviewsCountPerStar[$i] += $reviewsCount;
                    }
                }
            }

            return collect($reviewsCountPerStar);
        });
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
