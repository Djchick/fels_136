<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\Lesson;
use App\Repositories\Lesson\LessonRepositoryInterface;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface {

    protected $model;

    public function __construct(Lesson $lesson) {
        $this->model = $lesson;
    }

    public function create($data) {
        return Lesson::create($data);
    }
    
    public function lists($column_name, $id) {
        return Lesson::lists($column_name, $id)->toArray();
    }
}