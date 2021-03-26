<?php

namespace Rapidez\Reviews\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class WithReviewsScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->selectRaw('ANY_VALUE(review_entity_summary.rating_summary) AS reviews_score')
            ->selectRaw('ANY_VALUE(review_entity_summary.reviews_count) AS reviews_count')
            ->leftJoin('review_entity_summary', function ($join) use ($model) {
                $join->on($model->getTable() . '.entity_id', '=', 'review_entity_summary.entity_pk_value')
                    ->where('entity_type', 1);
            });
    }
}
