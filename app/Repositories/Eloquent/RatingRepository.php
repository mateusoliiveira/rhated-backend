<?php


namespace App\Repositories\Eloquent;

use App\Models\Rating;
use App\Repositories\Contracts\RatingRepositoryInterface;

class RatingRepository extends AbstractRepository implements RatingRepositoryInterface
{
    protected $model = Rating::class;
}
