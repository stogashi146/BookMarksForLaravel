<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unread extends Model
{
    public function book()
    {
        return $this->belongsTo("App\Book");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    protected $fillable =[
        "book_id",
        "user_id",
    ];
}
