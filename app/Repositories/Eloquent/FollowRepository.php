<?php


namespace App\Repositories\Eloquent;

use App\Models\Follow;
use App\Repositories\Contracts\FollowRepositoryInterface;

class FollowRepository extends AbstractRepository implements FollowRepositoryInterface
{
    protected $model = Follow::class;
}
