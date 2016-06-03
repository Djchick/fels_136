<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface {

    public function all($columns = ['*']);
    public function find($id, $columns = ['*']);
}