<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Word;
use App\Models\LearnedWord;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'category_id'];

    protected $guarded  = ['id'];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function words() {
        return $this->hasMany(Word::class);
    }

    public function lessonWords() {
        return $this->hasMany(LessonWord::class);
    }

    public function learningWords() {
        return $this->lessonWords();
    }

    public function learnedWords() {
        return $this->hasManyThrough("Word", "LearnedWord", "word_id", "id");
    }
}
