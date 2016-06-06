<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordAnswer extends Model {

    use SoftDeletes;

    protected $table = 'word_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'word_id', 'content', 'correct'];

    protected $dates = ['deleted_at'];

    public function word() {
        return $this->belongsTo(Word::class);
    }
}
