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
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->get();
                break;
            case "title_desc":
                // return Book::select()->with("reads")->whereHas("reads", function($q) use($user_id){
                //     $q->where("user_id", $user_id);})
                //     ->withCount("reads")->withCount("unreads")->orderByDesc("title")->get();
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("title")
                    ->get();
                break;
            case "title_asc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("title")
                    ->get();
                break;
            case "author_desc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("author")
                    ->get();
                break;
            case "author_asc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("author")
                    ->get();
                break;
            case "sales_desc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("sales_date")
                    ->get();
                break;
            case "sales_asc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("sales_date")
                    ->get();
                break;
            case "add_desc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("reads.created_at")
                    ->get();
                break;
            case "add_asc":
                return Book::select()->join("reads","reads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("reads.created_at")
                    ->get();
                break;
            }
    }

    public static function unread_sort($key, $user){
        $sort = $key;
        $user_id = $user -> id;

        switch($sort){
            case "default":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->get();
                break;
            case "title_desc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("title")
                    ->get();
                break;
            case "title_asc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("title")
                    ->get();
                break;
            case "author_desc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("author")
                    ->get();
                break;
            case "author_asc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("author")
                    ->get();
                break;
            case "sales_desc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("sales_date")
                    ->get();
                break;
            case "sales_asc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("sales_date")
                    ->get();
                break;
            case "add_desc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderByDesc("unreads.created_at")
                    ->get();
                break;
            case "add_asc":
                return Book::select()->join("unreads","unreads.book_id", "=", "books.id")
                    ->where("user_id", $user_id)
                    ->withCount("reads")->withCount("unreads")
                    ->orderBy("unreads.created_at")
                    ->get();
                break;
            }
    }

    public static function follow_sort($key, $user){
        $sort = $key;
        $user_id = $user -> id;

        switch($sort){
            case "default":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->get();
                break;
            case "name_desc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("name")->get();
                break;
            case "name_asc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("name")->get();
                break;
            case "add_desc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("relationships.created_at")->get();
                break;
            case "add_asc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("relationships.created_at")->get();
                break;
            case "read_desc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("reads_count")->get();
                break;
            case "read_asc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("reads_count")->get();
                break;
            case "unread_desc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("unreads_count")->get();
                break;
            case "unread_asc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("unreads_count")->get();
                break;
            case "follow_desc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("follower_count")->get();
                break;
            case "follow_asc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("follower_count")->get();
                break;
            case "follower_desc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("followed_count")->get();
                break;
            case "follower_asc":
                return User::select()->join("relationships", "relationships.followed_id", "=", "users.id")
                    ->where("follower_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("followed_count")->get();
                break;
            }
    }

    public static function followed_sort($key, $user){
        $sort = $key;
        $user_id = $user -> id;

        switch($sort){
            case "default":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->get();
                break;
            case "name_desc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("name")->get();
                break;
            case "name_asc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("name")->get();
                break;
            case "add_desc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("relationships.created_at")->get();
                break;
            case "add_asc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("relationships.created_at")->get();
                break;
            case "read_desc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("reads_count")->get();
                break;
            case "read_asc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("reads_count")->get();
                break;
            case "unread_desc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("unreads_count")->get();
                break;
            case "unread_asc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("unreads_count")->get();
                break;
            case "follow_desc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("follower_count")->get();
                break;
            case "follow_asc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("follower_count")->get();
                break;
            case "follower_desc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderByDesc("followed_count")->get();
                break;
            case "follower_asc":
                return User::select()->join("relationships", "relationships.follower_id", "=", "users.id")
                    ->where("followed_id", $user_id)
                    ->withCount("reads")->withCount("unreads")->withCount("follower")->withCount("followed")
                    ->orderBy("followed_count")->get();
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
