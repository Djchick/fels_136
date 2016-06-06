<?php

namespace App\Repositories\Word;

interface WordRepositoryInterface {

    public function all($columns = ['*']);
    
    public function find($id, $columns = ['*']);

}