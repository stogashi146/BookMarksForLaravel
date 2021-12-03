<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function reads()
    {
        return $this->hasMany("App\Read");
    }

    public function unreads()
    {
        return $this->hasMany("App\Unread");
    }

    //  user->followerでユーザーが"フォローされている"ユーザー一覧を取得
    public function followed()
    {
        return $this->belongsToMany("App\User", "App\Relationship", "followed_id", "follower_id");
    }

    
    //  user->followedでユーザーが"フォローしている"ユーザー一覧を取得
    public function follower()
    {
        return $this->belongsToMany("App\User", "App\Relationship", "follower_id", "followed_id");
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        "name",
        "email",
        "password",
        "introduction",
        "image",
        "is_deleted",
        "is_mail_send",
        "uid",
        "provider",
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
}
