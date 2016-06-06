<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonWord extends Model {

    use SoftDeletes;

    protected $table = 'lesson_words';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lesson_id', 'word_id'];

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function word() {
        return $this->belongsTo(Word::class);
    }
}