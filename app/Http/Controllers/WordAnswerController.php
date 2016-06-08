<?php
namespace App\Http\Controllers;

use App\Models\Word;
use App\Repositories\WordAnswer\WordAnswerRepositoryInterface;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\WordAnswerRequest;

class WordAnswerController extends Controller {

    protected $wordAnswerRepository;

    public function __construct(WordAnswerRepositoryInterface $wordAnswerRepository) {
        $this->wordAnswerRepository = $wordAnswerRepository;
    }

    public function index() {
    }

    public function update(WordAnswerRequest $request, $id) {
        $wordAnswerData = $request->get("word_answers");
        $correctAnswers = $this->wordAnswerRepository->wordAnswers($wordAnswerData['correct']);
        return redirect()->route('word.index')->withMessage(trans('wordAnswer/messages.finish_test', array(
            'value' => $correctAnswers,
            'sum' => count($wordAnswerData['content']),
        )));
    }

    public function show($id) {
    }

    public function store(Request $request, $id) {
    }

    public function edit($id) {
    }

    public function delete($id) {
    }
}