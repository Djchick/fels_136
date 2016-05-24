<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function all($columns = ['*']);
    public function find($id, $columns = ['*']);
}