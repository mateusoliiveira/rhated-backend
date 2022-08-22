<?php


namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function get()
    {
        return $this->model->get();
    }

    public function where($table, $type, $q)
    {
        return $this->model->where($table, $type, $q);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function with($table)
    {
        return $this->model->with($table);
    }

    public function has($table)
    {
        return $this->model->has($table);
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

}
