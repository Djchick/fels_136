<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Word extends Model {

    use SoftDeletes;

    protected $table = 'words';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'category_id'];

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function lessonWord() {
        return $this->hasOne(LessonWord::class);
    }

    public function wordAnswers() {
        return $this->hasMany(WordAnswer::class);
    }

    public function learnedWords() {
        return $this->hasMany(LearnedWord::class);
    }

    public function isLearned() {
        return $this->hasOne(LearnedWord::class)->where('user_id', Auth::user()->id);
    }
}
