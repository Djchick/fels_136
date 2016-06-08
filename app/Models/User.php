<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Hash;
use Mockery\CountValidator\Exception;
use Image;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'email', 'password', 'avatar', 'role', 'id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['password', 'remember_token']; 

    protected $dates = ['deleted_at'];

    protected $rules;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->rules = config('common.user.rule');
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function learnedWords() {
        return $this->hasMany(LearnedWord::class);
    }

    public function followers() {
        return $this->hasManyThrough(User::class, Relationship::class, 'following_id', 'id', 'id');
    }

    public function relationships() {
        return $this->hasMany(Relationship::class, 'follower_id');
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

    public function uploadImage($image) {
        $imageName       = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($this->rules['upload_path']);
        try {
            if(!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize($this->rules['avatar_resize'], $this->rules['avatar_resize'], function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $imageName);
        } catch(Exception $e) {
            return false;
        }
        $currentAvatar = $destinationPath . '/' . $this->avatar;
        if(is_file($currentAvatar) && is_writable($currentAvatar)) {
            unlink($currentAvatar);
        }
        return $imageName;
    }

    public function getUserAvatar() {
        return $this->rules['upload_path'] . "/" . $this->avatar;
    }

}