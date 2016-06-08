<?php

namespace App\Repositories\WordAnswer;

interface WordAnswerRepositoryInterface {

    public function all($columns = ['*']);

    public function find($id, $columns = ['*']);
}