<?php
 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class BaseRepository
{
    protected $model;

    public function all($columns = ['*']) {
        return $this->model->all();
    }

    public function find($id, $columns = ['*']) {
        return $this->model->find($id);
    }
}