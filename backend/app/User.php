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

    public static function read_sort($key, $user){
        $sort = $key;
        $user_id = $user -> id;

        switch($sort){
            case "default":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->get();
                break;
            case "title_desc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderByDesc("title")->get();
                break;
            case "title_asc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderBy("title")->get();
                break;
            case "author_desc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderByDesc("author")->get();
                break;
            case "author_asc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderBy("author")->get();
                break;
            case "sales_desc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderByDesc("sales_date")->get();
                break;
            case "sales_asc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderBy("sales_date")->get();
                break;
            case "add_desc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderByDesc("created_at")->get();
                break;
            case "add_asc":
                return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                    $q->where("user_id", $user_id);})
                    ->withCount("reads")->withCount("unreads")->orderBy("created_at")->get();
                break;
            }
    }

    public static function unread_sort($key, $user){
        $sort = $key;
        $user_id = $user -> id;

        switch($sort){
            case "default":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->get();
                break;
            case "title_desc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("books.title","desc")
                    ->get();
                break;
            case "title_asc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("books.title","asc")
                    ->get();
                break;
            case "author_desc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("books.author","desc")
                    ->get();
                break;
            case "author_asc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("books.author","asc")
                    ->get();
                break;
            case "sales_desc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("books.sales_date","desc")
                    ->get();
                break;
            case "sales_asc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("books.sales_date","asc")
                    ->get();
                break;
            case "add_desc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("unreads.created_at","desc")
                    ->get();
                break;
            case "add_asc":
                return Unread::select()->join("books","books.id", "=", "unreads.book_id")
                    ->where("user_id", $user_id)
                    ->orderBy("unreads.created_at","asc")
                    ->get();
                break;
            }
    }

    public static function follow_sort($key, $user){
        $sort = $key;

        switch($sort){
            case "default":
                return $user->follower;
                break;
            case "name_desc":
                return $user->follower->sortByDesc("name");
                break;
            case "name_asc":
                return $user->follower->sortBy("name");
                break;
            case "add_desc":
                return $user->follower->sortByDesc("created_at");
                break;
            case "add_asc":
                return $user->follower->sortBy("created_at");
                break;
            }
    }

    public static function followed_sort($key, $user){
        $sort = $key;

        switch($sort){
            case "default":
                return $user->followed;
                break;
            case "name_desc":
                return $user->followed->sortByDesc("name");
                break;
            case "name_asc":
                return $user->followed->sortBy("name");
                break;
            case "add_desc":
                return $user->followed->sortByDesc("created_at");
                break;
            case "add_asc":
                return $user->followed->sortBy("created_at");
                break;
            }
    }

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
