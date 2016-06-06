<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

    protected $model;

    public function __construct(Category $category) {
        $this->model = $category;
    }

    public function create($data) {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function lists($column_name,$id) {
        return Category::lists($column_name,$id);
    }
}