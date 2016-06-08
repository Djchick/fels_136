<?php
namespace App\Repositories;

use App\Models\Activity;
use App\Repositories\BaseRepository;
use Exception;
use App\Models\WordAnswer;
use App\Models\LearnedWord;
use App\Repositories\WordAnswer\WordAnswerRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use DB;

class WordAnswerRepository extends BaseRepository implements WordAnswerRepositoryInterface {

    protected $model;

    protected $learnedWord;

    public function __construct(WordAnswer $wordAnswer, LearnedWord $learnedWord) {
        $this->model = $wordAnswer;
        $this->learnedWord = $learnedWord;
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function wordAnswers($data) {
        $user = Auth::user();
        $counter = 0;
        foreach($data as $wordId => $answerId) {
            $wordAnswer = $this->find($answerId);
            if($wordAnswer && $wordAnswer->word_id == $wordId && $wordAnswer->correct == LearnedWord::CORRECT) {
                $learnedWord['user_id'] = $user->id;
                $word = $wordAnswer['word'];
                $word->learnedWords()->saveMany([0 => new LearnedWord($learnedWord)]);
                $counter ++;
            }
        }
        return true;
    }
}