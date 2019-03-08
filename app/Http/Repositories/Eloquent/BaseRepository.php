<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/11/2019
 * Time: 11:27 AM
 */

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\BaseRepositoryInterface;
use App\Http\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @throws RepositoryException
     */
    public function __construct() {
        $this->model = $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @throws RepositoryException
     */
    public function makeModel()
    {
        if (!method_exists($this, 'model')) {
            throw new RepositoryException();
        }

        $model = app($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $model;
    }
}