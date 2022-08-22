<?php


namespace App\Repositories\Eloquent;

use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandRepository extends AbstractRepository implements BrandRepositoryInterface
{
    protected $model = Brand::class;
}
