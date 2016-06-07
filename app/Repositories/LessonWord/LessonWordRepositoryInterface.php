<?php

namespace App\Repositories\LessonWord;

interface LessonWordRepositoryInterface {

    public function all($columns = ['*']);

    public function find($id, $columns = ['*']);
}