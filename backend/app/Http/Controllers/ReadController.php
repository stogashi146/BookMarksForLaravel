<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Read;

class ReadController extends Controller
{
    public function store(Request $request)
    {
        $book = request("book");
        $user = \Auth::user()->id;
        $read = Read::create(["book_id" => $book, "user_id" => $user, "comment" => request("comment")]);

        return redirect()->route("book.show", ["book"=>$book]);
    }

    public function destroy(Request $request)
    {
        $book = $request->query("book");
        $user = \Auth::user();
        $read = $user -> reads -> where("book_id", $book) -> first();

        $read -> delete();

        return redirect()->route("book.show", ["book"=>$book]);
    }

    public function update(Request $request){
        $read = Read::find(request("read"));
        $read->comment = request("comment");
        $read -> save();

        // return redirect()->route("book.show", ["book"=>$book]);
        return back();
    }
    
}
