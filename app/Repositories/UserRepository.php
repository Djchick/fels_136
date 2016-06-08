<?php 

namespace App\Repositories;

use App\Models\Relationship;
use App\Repositories\BaseRepository;
use Exception;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($data) {
        if(isset($data['avatar'])) {
            $uploadImage = $this->model->uploadImage($data['avatar']);
            if($uploadImage) {
                $data['avatar'] = $uploadImage;
            }
        }
        $this->model->create($data);
        return true;
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