<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($data) {
        return $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function changePassword($data) {
        $user = $this->find($data['userId']);
        if(! $user) {
           return false;
        }
        $user->setPasswordAttribute($data['password']);
        return $user->save();
    }

    public function get() {
        $pagination = config("common.pagination");
        return $this->model->paginate($pagination);
    }
}