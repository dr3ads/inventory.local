<?php namespace Lib;

use Lib\RepositoryInterface;

/**
 * Class Repository
 * @package Bosnadev\Repositories\Eloquent
 */
abstract class AbstractRepository implements RepositoryInterface
{

    /**
     * @var
     */
    protected $model;

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->all();
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
    public function update(array $data, $id, $attribute = "id")
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
     * Method to retrieve a key value pair
     *
     * @param $column
     * @param string $key_column
     * @return array
     */
    public function getValueByKey($column, $key_column = '')
    {
        if (!$key_column) {
            $key_column = $this->model->getKeyName();
        }

        $list = $this->model->all();

        $data = [];

        foreach ($list as $row) {
            $data[$row->{$key_column}] = $row->{$column};
        }

        return $data;
    }

    public function getMutatedValueByKey($column, $key_column = 'id')
    {
        $data = $this->model->all(array($column, $key_column));
        $return = array();
        foreach ($data as $item) {
            $return[$item[$key_column]] = $item[$column];
        }

        return $return;
    }

    /**
     * @return $this
     */
    public function newQuery()
    {
        $this->model = $this->model->newQuery();
        return $this;
    }

    /**
     * @param $relations
     * @return $this
     */
    public function with($relations) {
        if (is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }

    protected function eagerLoadRelations() {
        if(!is_null($this->with)) {
            foreach ($this->with as $relation) {
                $this->model->with($relation);
            }

            //$this->model->with(implode(',',$this->with));
        }
        return $this;
    }
}