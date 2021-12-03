<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    public function follower()
    {
        return $this->belongsTo("App\User");
    }

    public function followed()
    {
        return $this->belongsTo("App\User");
    }

    protected $fillable =[
        "follower_id",
        "followed_id",
    ];
}
