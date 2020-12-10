<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 更新用のルール
    public static $rulesUpdate = [
        'name' => ['required', 'string', 'max:30'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['confirmed'],
        'profile' => ['required', 'string', 'max:255'],
    ];

    /**
     * リレーション
     *
     * User has many Albums
     */

     public function diaries()
     {
         return $this->hasMany('App\Diary');
     }

     public static function boot()
     {
       parent::boot();

       static::deleting(function($user) {
         $user->diaries()->delete();
       });
     }
}
