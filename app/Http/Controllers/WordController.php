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

    protected $wordRepository;
    protected $categoryRepository;
    protected $lessonRepository;
    
    public function __construct(WordRepositoryInterface $wordRepository,
            CategoryRepositoryInterface $categoryRepository, LessonRepositoryInterface $lessonRepository) {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index(Request $request) {
        $words = $this->wordRepository->get();
        if($request->get("lesson_id")) {
            $lessonId = $request->get('lesson_id');
            $lesson = $this->lessonRepository->find($lessonId);
            if($lesson) {
                $this->viewData['lesson'] = $lesson;
                return view('word.learning', $this->viewData);
            } else {
                return redirect()->route('lesson.index')->withErrors(trans('lesson/messages.common_error'));
            }
        } else {
            $page = $request->get("page");
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
            return redirect()->route('word.index')->withMessage(trans('word/messages.delete_complete'));
        }
        return redirect()->route('word.index')->withErrors(trans('word/messages.common_error'));
    }

    public function show($id) {
        $request = request();
        if($request->get("action") && $request->get("action") == "learning") {
            $word = $this->wordRepository->find($id);
            if($word && !$word->isLearned) {
                $this->viewData['word'] = $word;
                return view('word.learning_word', $this->viewData);
            }
            return redirect()->route('word.index')->withErrors(trans('word/messages.common_error'));
        }
        return redirect()->route('word.index')->withErrors(trans('word/messages.common_error'));
    }
}