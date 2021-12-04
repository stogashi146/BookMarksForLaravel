<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reads($id)
    {
        $read_sort = config('array.read_sort');
        $user = User::find($id);
        $reads = User::read_sort(request("sort"), $user);
        $follow = \Auth::user() -> follower -> where("id", $user->id) -> first();
        $followings_users = $user -> follower;
        $followers_users = $user -> followed;
        return view('user/reads',compact("user", "reads", "follow", "followings_users", "followers_users", "read_sort"));
    }

    public function unreads($id)
    {
        $read_sort = config('array.read_sort');
        $user = User::find($id);
        $unreads = User::unread_sort(request("sort"), $user);
        $follow = \Auth::user() -> follower -> where("id", $user->id) -> first();
        $followings_users = $user -> follower;
        $followers_users = $user -> followed;
        return view('user/unreads',compact("user", "unreads", "follow", "followings_users", "followers_users", "read_sort"));
    }

    public function following($id)
    {
        $follow_sort = config('array.follow_sort');
        $user = User::find($id);
        $follow = \Auth::user() -> follower -> where("id", $user->id) -> first();
        $followings = User::follow_sort(request("sort"), $user);
        $followings_users = $user -> follower;
        $followers_users = $user -> followed;
        return view('user/following',compact("user", "follow", "followings", "followings_users", "followers_users", "follow_sort"));
    }

    public function followers($id)
    {
        $follow_sort = config('array.follow_sort');
        $user = User::find($id);
        $follow = \Auth::user() -> follower -> where("id", $user->id) -> first();
        $followers = User::followed_sort(request("sort"), $user);
        $followings_users = $user -> follower;
        $followers_users = $user -> followed;
        return view('user/followers',compact("user", "follow", "followers", "followings_users", "followers_users", "follow_sort"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user/edit', compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = request("name");
        $user->email = request("email");
        $user->introduction = request("introduction");

        if($request->file("image")){
            // 画像ファイル名を取得
            $image = $request->file("image")->getClientOriginalName(); //ファイル名を拡張子まで取得
            request()->file("image")->storeAs("public/images", $image);
            $user->image = $image;
        }
        $user -> save();

        return redirect()->route("user.reads", ["user"=>$user, "sort" => "default"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
