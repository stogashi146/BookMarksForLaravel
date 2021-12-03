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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user/show',compact("user"));
    }

    public function reads($id)
    {
        $user = User::find($id);
        return view('user/reads',compact("user"));
    }

    public function unreads($id)
    {
        $user = User::find($id);
        return view('user/unreads',compact("user"));
    }

    public function following($id)
    {
        $user = User::find($id);
        return view('user/following',compact("user"));
    }

    public function followers($id)
    {
        $user = User::find($id);
        return view('user/followers',compact("user"));
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
        // 画像ファイル名を取得
        $image = $request->file("image")->getClientOriginalName(); //ファイル名を拡張子まで取得
        request()->file("image")->storeAs("public/images", $image);

        $user = User::find($id);
        $user->name = request("name");
        $user->email = request("email");
        $user->introduction = request("introduction");
        $user->image = $image;
        $user -> save();

        return redirect()->route("user.show", ["user"=>$user]);
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
