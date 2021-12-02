<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unread;

class UnreadController extends Controller
{
    public function store(Request $request)
    {
        $book = $request->query("book");
        $user = \Auth::user()->id;
        $unread = Unread::create(["book_id" => $book, "user_id" => $user]);

        return redirect()->route("book.show", ["book"=>$book]);
    }

    public function destroy(Request $request)
    {
        $book = $request->query("book");
        $user = \Auth::user();
        $unread = $user -> unreads -> where("book_id", $book) -> first();

        $unread -> delete();

        return redirect()->route("book.show", ["book"=>$book]);
    }
}
