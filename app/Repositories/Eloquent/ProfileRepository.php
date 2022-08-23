<?php


namespace App\Repositories\Eloquent;

use App\Models\Profile;
use App\Repositories\Contracts\ProfileRepositoryInterface;

class ProfileRepository extends AbstractRepository implements ProfileRepositoryInterface
{
    protected $model = Profile::class;
}
