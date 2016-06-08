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
    protected $fillable = ['user_id', 'word_id'];

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'word_id', 'id');
    }

    public function word() {
        return $this->belongsTo(Word::class);
    }
}