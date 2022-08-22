<?php


namespace App\Repositories\Eloquent;

use App\Models\Offer;
use App\Repositories\Contracts\OfferRepositoryInterface;

class OfferRepository extends AbstractRepository implements OfferRepositoryInterface
{
    protected $model = Offer::class;
}
