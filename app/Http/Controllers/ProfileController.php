<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileRequest;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use Ramsey\Uuid\Rfc4122\UuidV4;

class ProfileController extends Controller
{
    protected $model;
    protected $request;
    public function __construct(
        ProfileRepositoryInterface $model,
        ProfileRequest $request
        )
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
       return $this->model->get();
    }

    public function store()
    {
       return $this->model->create($this->request->validated());
    }

    public function show($id)
    {
       return $this->model->show($id);
    }

    public function destroy($id)
    {
       return $this->model->delete($id);
    }
}
