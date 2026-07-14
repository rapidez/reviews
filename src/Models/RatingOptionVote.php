<?php

namespace Rapidez\Reviews\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rapidez\Core\Models\Model;

class RatingOptionVote extends Model
{
    protected $table = 'rating_option_vote';

    protected $primaryKey = 'vote_id';

    public function product(): BelongsTo
    {
        return $this->belongsTo(config('rapidez.models.product'), 'entity_pk_value', 'entity_id');
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'review_id', 'review_id');
    }
}
