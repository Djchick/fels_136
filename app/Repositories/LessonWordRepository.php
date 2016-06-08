<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\LessonWord;
use App\Repositories\LessonWord\LessonWordRepositoryInterface;

class LessonWordRepository extends BaseRepository implements LessonWordRepositoryInterface {

    protected $model;

    public function __construct(LessonWord $lessonWord) {
        $this->model = $lessonWord;
    }

    public function create($data) {
        return $this->model->create($data);
    }
}