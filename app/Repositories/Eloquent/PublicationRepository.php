<?php


namespace App\Repositories\Eloquent;

use App\Models\Publication;
use App\Repositories\Contracts\PublicationRepositoryInterface;

class PublicationRepository extends AbstractRepository implements PublicationRepositoryInterface
{
    protected $model = Publication::class;
}
