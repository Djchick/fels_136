<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Activity\ActivityRepositoryInterface;
use Illuminate\Pagination\Paginator;

class ActivityController extends Controller {

    /**
     * The activity instance.
     */
    protected $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    public function index(Request $request) {
        $activities = $this->activityRepository->get();
        $page = $request->get("page");
        $lastPage = $activities->lastPage();
        if($page && $page > $lastPage) {
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $activities = $this->activityRepository->get();
        }
        $this->viewData['activities'] = $activities;
        return view('activity.list',$this->viewData);
    }
}