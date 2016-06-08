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
        $wordAnswerIds = array_values($data);
        $wordAnswers = $this->find($wordAnswerIds);
        $learnedWords = [];
        foreach($wordAnswers as $wordAnswer) {
            if($wordAnswer->correct == LearnedWord::CORRECT) {
                $learnedWords[] = new LearnedWord(['word_id' => $wordAnswer->word_id]);
            }
        }
        $counter = count($learnedWords);
        if($counter > 0) {
            DB::beginTransaction();
            try {
                $user->learnedWords()->saveMany($learnedWords);
                $activityValues = [
                    'code' => 'learned_new_words',
                    'value' => $counter,
                ];
                $user->activities()->saveMany([new Activity(["content" => json_encode($activityValues)])]);
            } catch(\Exception $e) {
                DB::rollback();
                return false;
            }
            DB::commit();
        }
        return $counter;
    }
}