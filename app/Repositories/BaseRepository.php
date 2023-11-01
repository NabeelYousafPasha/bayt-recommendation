<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = new $model();
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function get()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->whereId($id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
