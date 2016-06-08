<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\Activity;
use App\Repositories\Activity\ActivityRepositoryInterface;
use DB;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface {

    protected $model;

    public function __construct(Activity $activity) {
        $this->model = $activity;
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function get() {
        $pagination = config("common.pagination");
        return $this->model->orderBy('created_at', 'desc')->paginate($pagination);
    }
}