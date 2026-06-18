<?php

namespace Rapidez\Reviews\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Rapidez\Core\Models\Model;
use Rapidez\Reviews\Models\Review;

class RatingOptionVote extends Model
{
    protected $table = 'rating_option_vote';

    protected $primaryKey = 'vote_id';

    function product(): BelongsTo {
        return $this->belongsTo(config('rapidez.models.product'), 'entity_pk_value', 'entity_id');
    }

    function review(): BelongsTo {
        return $this->belongsTo(Review::class, 'review_id', 'review_id');
    }
}
