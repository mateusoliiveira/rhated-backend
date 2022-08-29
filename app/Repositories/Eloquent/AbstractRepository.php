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

    public function leftJoin($table, $in, $signal, $out)
    {
        return $this->model->leftJoin($table, $in, $signal, $out);
    }

    public function select($data)
    {
        return $this->model->select($data);
    }

    public function whereIn($row, $data)
    {
        return $this->model->whereIn($row, $data);
    }

    public function orWhereIn($in, $values)
    {
        return $this->model->whereIn($in, $values);
    }

    public function whereBelongsTo($table)
    {
        return $this->model->whereBelongsTo($table);
    }

    public function join($table, $func = null)
    {
        return $this->model->join($table, $func);
    }

    public function on($origin, $type, $out)
    {
        return $this->model->on($origin, $type, $out);
    }

    public function whereLike($row, $q)
    {
        return $this->model->whereLike($row, $q);
    }

    public function withCount($table)
    {
        return $this->model->withCount($table);
    }

    public function latest()
    {
        return $this->model->latest();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

}
