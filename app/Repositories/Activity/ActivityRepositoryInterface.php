<?php
namespace App\Repositories\Activity;

interface ActivityRepositoryInterface {

    public function all($columns = ['*']);

    public function find($id, $columns = ['*']);
}