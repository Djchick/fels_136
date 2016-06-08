<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\Activity;
use App\Repositories\Activity\ActivityRepositoryInterface;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface {

    protected $model;

    public function __construct(Activity $activity) {
        $this->model = $activity;
    }

    public function create($data) {
        return $this->model->create($data);
    }

}