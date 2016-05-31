<?php

namespace App\Repositories\Lesson;

interface LessonRepositoryInterface {

    public function all($columns = ['*']);
    public function find($id, $columns = ['*']);
}