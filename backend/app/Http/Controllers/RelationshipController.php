<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relationship;

class RelationshipController extends Controller
{
    public function store(Request $request)
    {
        $follower = \Auth::user()->id;
        $followed = $request->query("user");

        Relationship::create(["follower_id" => $follower, "followed_id" => $followed]);
        return back();
    }

    public function destroy(Request $request)
    {
        $follower = \Auth::user()->id;
        $followed = $request->query("user");
        $unfollow = Relationship::where("follower_id", $follower) -> where("followed_id", $followed) -> first();
        
        $unfollow -> delete();
        return back();
    }
}
