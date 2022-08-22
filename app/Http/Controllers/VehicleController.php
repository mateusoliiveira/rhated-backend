<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Ramsey\Uuid\Rfc4122\UuidV4;

class VehicleController extends Controller
{
    protected $model;
    protected $request;
    public function __construct(
        VehicleRepositoryInterface $model,
        VehicleRequest $request
        )
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
       return $this->model->with('categories')->with('brands')->get();
    }

    public function store()
    {
        return $this->model->create($this->request->validated());
    }

    public function insert()
    {
       return $this->model->insert((array_map(fn($request): array => [
         "id" => UuidV4::uuid4(),
         "created_at" => now(),
         "updated_at" => now(),
         ...$request
       ], $this->request->all())));
    }

    public function show($id)
    {
       return $this->model->with('categories')->with('brands')->find($id);
    }

    public function destroy($id)
    {
       return $this->model->delete($id);
    }
}
