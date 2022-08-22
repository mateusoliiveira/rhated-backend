<?php


namespace App\Repositories\Eloquent;

use App\Models\Vehicle;
use App\Repositories\Contracts\VehicleRepositoryInterface;

class VehicleRepository extends AbstractRepository implements VehicleRepositoryInterface
{
    protected $model = Vehicle::class;
}
