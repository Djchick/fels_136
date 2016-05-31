<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $guarded  = ['id'];

    protected $dates = ['deleted_at'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function words() {
        return $this->hasMany(Word::class);
    }
}
