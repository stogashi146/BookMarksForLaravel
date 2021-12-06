<?php

namespace App\Http\Controllers;

use App\Book;
use App\Read;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = request("keyword");
        $page = request("page");
        $books = Book::search_books($keyword, $page);
        return view('book/index',["books"=>$books, "keyword"=>$keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $book_request = $request->query("book");
        if(Book::where("isbn", $book_request["isbn"])->first()){
            $book = Book::where("isbn", $book_request["isbn"])->first();
        }else{
            $book = Book::create($book_request);
        }
        
        return redirect()->route("book.show", ["book"=>$book->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        $reads = Read::where("book_id", $book->id) -> with("user")->get();
        $user = \Auth::user();
        if($user){
            $read = $user -> reads -> where("book_id", $book->id) -> first();
            $unread = $user -> unreads -> where("book_id", $book->id) -> first();
        }else{
            $read = "";
            $unread = "";
        }
        
        return view('book/show',compact("book","read","unread","reads"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function ranking()
    {
        $ranking_sort = config('array.genre');
        $count = 1;

        if(request("sort")){
            $books = Book::search_books(request("keyword"), request("page"), $sales="sales", $genre=$ranking_sort[request("genre")], $hits="30");
        }elseif(request("read_ranking")){
            $books = Book::select()->withCount("reads")->withCount("unreads")
                ->orderByDesc("reads_count")->limit(30)->get();
        }elseif(request("unread_ranking")){
            $books = Book::select()->withCount("reads")->withCount("unreads")
                ->orderByDesc("unreads_count")->limit(30)->get();
        }

        return view('book/ranking',compact("ranking_sort","books","count"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
