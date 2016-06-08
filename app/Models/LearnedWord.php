<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearnedWord extends Model {

    use SoftDeletes;

    const CORRECT = 1;

    const INCORRECT = 0;

    protected $fillable = ['word_id', 'user_id'];

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function word() {
        return $this->belongsTo(Word::class);
    }
}