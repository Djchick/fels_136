<?php
namespace App\Http\Controllers;

use App\Models\Word;
use App\Repositories\Word\WordRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Auth;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\WordRequest;
use Illuminate\Pagination\Paginator;

class WordController extends Controller {

    /**
     * The user repository instance.
     */
    public function __construct(WordRepositoryInterface $wordRepository,
            CategoryRepositoryInterface $categoryRepository, LessonRepositoryInterface $lessonRepository) {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index() {
        $currentRequest = $this->getRouter()->getCurrentRequest();
        $words = $this->wordRepository->get();
        $page = $currentRequest->get("page");
        $lastPage = $words->lastPage();
        if($page && $page > $lastPage) {
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $words = $this->wordRepository->get();
        }
        $this->viewData['words'] = $words;
        return view('word.list', $this->viewData);
    }

    public function store(WordRequest $request) {
        $input = $request->only([
            'content',
            'category_id',
            'lesson_id',
            'word_answers',
        ]);
        $this->wordRepository->create($input);
        return redirect()->route('word.index')->withMessage(trans('word/messages.create_complete'));
    }

    public function create() {
        $this->viewData = [
            'categories' => $this->categoryRepository->lists("name", "id"),
        ];
        return view('word.add', $this->viewData);
    }

    public function getLessons(Request $request) {
        if($request->ajax()) {
            $categoryId = $request->get('category_id');
            $category = $this->categoryRepository->find($categoryId);
            $lessonData = [];
            if($category) {
                foreach($category->lessons as $lesson) {
                    $lessonData[$lesson->id] = $lesson->name;
                }
            }
            echo json_encode($lessonData);
        }
    }

    public function edit($id) {
        $word = $this->wordRepository->find($id);
        if(!$word) {
            return redirect()->route('word.index')->withErrors(trans('word/messages.not_found_error'));
        }
        $this->viewData = [
            'word' => $word,
            'categories' => $this->categoryRepository->lists("name", "id"),
        ];
        return view('word.edit', $this->viewData);
    }

    public function update(WordRequest $request, $id) {
        $input = $request->only([
            'content',
            "category_id",
            "lesson_id",
            'word_answers',
        ]);
        $input['id'] = $id;
        $update = $this->wordRepository->update($input);
        if($update) {
            return redirect()->route('admin.word.edit', $id)->withMessage(trans('user/messages.update_complete'));
        }
        return redirect()->route('admin.word.edit', $id)->withErrors(trans('lesson/messages.common_error'));
    }

    public function destroy($id) {
        $word = $this->wordRepository->find($id);
        if($word && $word->delete()) {
            $word->lessonWord()->delete();
            return redirect()->route('word.index')->withMessage(trans('lesson/messages.delete_complete'));
        }
        return redirect()->route('word.index')->withErrors(trans('lesson/messages.common_error'));
    }

    public function delete($id) {
        $request = $this->getRouter()->getCurrentRequest();
        if($request->ajax()) {
            $word = $this->wordRepository->delete(['id' => $id]);
            if($word) {
                $request->session()->flash('message', trans('word/messages.delete_complete'));
            } else {
                $request->session()->flash('error', trans('word/messages.common_error'));
            }
        }
    }
}