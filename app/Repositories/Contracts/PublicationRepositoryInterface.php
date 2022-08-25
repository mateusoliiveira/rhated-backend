<?php

namespace App\Repositories\Contracts;

interface PublicationRepositoryInterface
{
    public function get();
    public function where($table, $type, $q);
    public function create(array $data);
    public function insert(array $data);
    public function delete($id);
    public function show($id);
    public function with($table);
    public function has($table);
    public function whereIn($row, $data);
    public function leftJoin($table, $in, $signal, $out);
    public function select($data);
    public function orWhereIn($in, $values);
    public function latest();

}
