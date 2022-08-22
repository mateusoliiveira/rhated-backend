<?php


namespace App\Repositories\Eloquent;

use App\Models\Brand;
use App\Repositories\Contracts\PublicationRepositoryInterface;

class PublicationRepository extends AbstractRepository implements PublicationRepositoryInterface
{
    protected $model = Brand::class;
}
