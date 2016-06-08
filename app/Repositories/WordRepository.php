<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use Exception;
use App\Models\Word;
use App\Models\WordAnswer;
use App\Models\LessonWord;
use App\Repositories\Word\WordRepositoryInterface;
use DB;

class WordRepository extends BaseRepository implements WordRepositoryInterface {

    protected $model;

    public function __construct(Word $word) {
        $this->model = $word;
    }

    public function get() {
        $pagination = config("common.pagination");
        return $this->model->paginate($pagination);
    }

    public function create($data) {
        $lessonWord['lesson_id'] = $data['lesson_id'];
        unset($data['lesson_id']);
        $wordAnswersObject = null;
        if(isset($data['word_answers'])) {
            $wordAnswers = $data['word_answers'];
            unset($data['word_answers']);
            foreach($wordAnswers['content'] as $index => $answer) {
                $correct = 0;
                if(isset($wordAnswers['correct']) && $wordAnswers['correct'] == $index) {
                    $correct = 1;
                }
                $wordAnswersObject[$index] = new WordAnswer(array(
                    'content' => $answer,
                    'correct' => $correct,
                ));
            }
        }
        DB::beginTransaction();
        try {
            $save = $this->model->create($data);
            if($wordAnswersObject) {
                $save->lessonWord()->save(new LessonWord($lessonWord));
                $save->wordAnswers()->saveMany($wordAnswersObject);
            }
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }

    public function delete($data) {
        $word = $this->find($data['id']);
        if($word) {
            return $word->lessonWord()->delete() && $word->delete();
        }
        return false;
    }

    public function update($data) {
        $word = $this->find($data['id']);
        $lessonWord['lesson_id'] = $data['lesson_id'];
        unset($data['lesson_id']);
        $wordAnswers = null;
        if(isset($data['word_answers'])) {
            $wordAnswers = $data['word_answers'];
            unset($data['word_answers']);
        }
        if($word && $wordAnswers) {
            $wordAnswersObject = null;
            foreach($wordAnswers['content'] as $index => $answer) {
                $correct = 0;
                if(isset($wordAnswers['correct']) && $wordAnswers['id'][$index] == $wordAnswers['correct']) {
                    $correct = 1;
                }
                $word['wordAnswers'][$index]['content'] = $answer;
                $word['wordAnswers'][$index]['correct'] = $correct;
            }
            DB::beginTransaction();
            try {
                $word->update($data) && $word->lessonWord()->update($lessonWord);
                $word->push();
            } catch(\Exception $e) {
                DB::rollback();
                return false;
            }
            DB::commit();
        }
        return true;
    }
}