<?php

namespace Rapidez\Reviews\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rapidez\Core\Models\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $primaryKey = 'review_id';

    protected static function booting()
    {
        static::addGlobalScope('approved', function ($builder) {
            $builder->where('status_id', 1); // Approved
        });
        static::addGlobalScope('product', function ($builder) {
            $builder->where('entity_id', 1); // Product
        });
    }

    public function ratingOptionVotes(): HasMany
    {
        return $this->hasMany(RatingOptionVote::class, 'review_id');
    }

    public function averagePercent(): Attribute
    {
        return Attribute::get(fn () => $this->loadMissing('ratingOptionVotes')->ratingOptionVotes->avg('percent'));
    }
}
