<?php
namespace App\Http\Controllers;

use App\Models\Word;
use App\Repositories\WordAnswer\WordAnswerRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\WordAnswer;
use Auth;
use Validator;
use Session;
use App\Http\Requests;

class WordAnswerController extends Controller {

    protected $wordAnswerRepository;

    public function __construct(WordAnswerRepositoryInterface $wordAnswerRepository) {
        $this->wordAnswerRepository = $wordAnswerRepository;
    }

    public function index() {
    }

    public function update(Request $request, $id) {
        $wordAnswerData = $request->get("word_answers");
        if(isset($wordAnswerData['correct'])) {
            $wordAnswer = $this->wordAnswerRepository->wordAnswers($wordAnswerData['correct']);
            if($wordAnswer) {
                return redirect()->route('word.index')->withMessage(trans('wordAnswer/messages.finish_test'));
            }
        }
        return redirect()->route('word.index')->withErrors(trans('wordAnswer/messages.common_error'));
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