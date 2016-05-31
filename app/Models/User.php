<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Hash;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'email', 'password', 'avatar', 'role'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['password', 'remember_token']; 

    protected $dates = ['deleted_at'];

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
    
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isUser()
    {
        $rule = config('common.user.rule');
        return $this->role == $rule['role_user'];
    }

    public function isAdmin()
    {
        $rule = config('common.user.rule');
        return $this->role == $rule['role_admin'];
    }


}