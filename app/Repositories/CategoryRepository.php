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

    public function get() {
        $pagination = config("common.pagination");
        return $this->model->paginate($pagination);
    }

    public function lists($column_name,$id) {
        return $this->model->lists($column_name, $id);
    }

    public function getCategoryLesson($categoryId) {
        $category = $this->find($categoryId);
        $lessonData = [];
        if($category) {
            foreach($category->lessons as $lesson) {
                $lessonData[$lesson->id] = $lesson->name;
            }
        }
        return $lessonData;
   }

}