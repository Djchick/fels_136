<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Lesson\LessonRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Auth;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller {

    /**
     * The user repository instance.
     */
    
    protected $lessonRepository;
    protected $categoryRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository, CategoryRepositoryInterface $categoryRepository) {
        $this->lessonRepository   = $lessonRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {
        $lessons = $this->lessonRepository->all();
        $this->viewData['lessons'] = $lessons;
        return view('lesson.list', $this->viewData);
    }

    public function store(LessonRequest $request) {
        $input = $request->only([
            'name',
            'category_id',
        ]);
        if(!$this->lessonRepository->create($input)) {
            return redirect()->route('admin.lesson.create')->withErrors(trans('lesson/messages.common_error'));
        }
        return redirect()->route('lesson.index')->withMessage(trans('lesson/messages.create_complete'));
    }

    public function create() {
        $this->viewData['categories'] = $this->categoryRepository->lists('name', 'id');
        return view('lesson.add', $this->viewData);
    }

    public function edit($id) {
        $lesson = $this->lessonRepository->find($id);
        $this->viewData = [
            'lesson'     => $lesson,
            'categories' => $this->categoryRepository->lists('name', 'id'),
        ];
        return view('lesson.edit', $this->viewData);
    }

    public function update(LessonRequest $request, $id) {
        $updateUser = $this->lessonRepository->find($id);
        $update = $updateUser->update($request->only([
            'name',
            'category_id',
        ]));
        if($update) {
            return redirect()->route('admin.lesson.edit', $id)->withMessage(trans('user/messages.update_complete'));
        }
        return redirect()->route('admin.lesson.create')->withErrors(trans('lesson/messages.common_error'));
    }

    public function destroy($id) {
        $lesson = $this->lessonRepository->find($id);
        if($lesson && $lesson->delete()) {
            return redirect()->route('lesson.index')->withMessage(trans('lesson/messages.delete_complete'));
        }
        return redirect()->route('lesson.index')->withErrors(trans('lesson/messages.common_error'));
    }
}