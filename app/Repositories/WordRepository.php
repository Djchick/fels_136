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
        DB::beginTransaction();
        try {
            $save = Word::create($data);
            $save->lessonWord()->save(new LessonWord($lessonWord));
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }

    public function delete($data) {
        $word = Word::find($data['id']);
        if($word) {
            return $word->lessonWord()->delete() && $word->delete();
        }
        return false;
    }

    public function update($data) {
        $word = Word::find($data['id']);
        $lessonWord['lesson_id'] = $data['lesson_id'];
        unset($data['lesson_id']);
        DB::beginTransaction();
        try {
            $word->update($data) && $word->lessonWord()->update($lessonWord);
            $word->push();
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }
}