<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/11/2019
 * Time: 11:32 AM
 */

namespace App\Http\Repositories\Contracts;


interface BaseRepositoryInterface
{
    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));
}