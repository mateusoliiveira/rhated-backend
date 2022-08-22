<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function get();
    public function where($table, $type, $q);
    public function create(array $data);
    public function insert(array $data);
    public function delete($id);
    public function show($id);
    public function with($table);
    public function has($table);

}
