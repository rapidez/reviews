<?php

namespace Rapidez\Review\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class WithReviewScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->selectRaw('ANY_VALUE(review_entity_summary.rating_summary) AS rating_summary')
            ->selectRaw('ANY_VALUE(review_entity_summary.reviews_count) AS reviews_count')
            ->leftJoin('review_entity_summary', $model->getTable() . '.entity_id', '=', 'review_entity_summary.entity_pk_value');
    }
}
