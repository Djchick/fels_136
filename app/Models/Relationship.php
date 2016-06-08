<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relationship extends Model {

    use SoftDeletes;

    protected $table = 'relationships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'following_id',
        'follower_id',
    ];

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function followers() {
        return $this->hasMany(User::class, 'id', 'follower_id');
    }

    public function word() {
        return $this->belongsTo(Word::class);
    }
}