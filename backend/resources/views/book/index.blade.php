@extends("layouts/layout")

@section("content")
<div class="container">
  <div class="row">
    <div class="col-md-3 my-2">
      <!-- <%= render "sort" %> -->
    </div>
  </div>
</div>
<div class="row">
  <div class="text-center bg-white py-3">
    @foreach($books["Items"] as $book)
      <a class="col-md-2 col-sm-6 m-2" href="{{ route("book.store",["book"=> App\Book::book_exists($book)]) }}" onclick="event.preventDefault();
                                                                           document.getElementById('book-create-{{$book["isbn"]}}').submit();">
        <img src="{{ str_replace("?_ex=200x200","",$book["largeImageUrl"]) }}" alt=""　width="25%" height="370px" class="book_index_jacket">  
      </a>

      <form id="book-create-{{$book["isbn"]}}" action="{{ route("book.store",["book"=> App\Book::book_exists($book)]) }}" method="POST" style="display: none;">
          @csrf
      </form>

    @endforeach
  </div>
</div>
<div class="row d-flex justify-content-center my-3 mb-5">
  @if(1 < $books["page"] && $books["page"] <= $books["pageCount"])
    <h4>
      <a href="{{ route("books.list", ["keyword"=>$keyword, "page" => $books["page"]-1])  }}" class="btn btn-light mx-2 " data={ disable_with: "処理中..." }>
        前のページ
      </a>
    </h4>
  @endif
  @if(1 <= $books["page"] && $books["page"] < $books["pageCount"])
    <h4>
      <a href="{{ route("books.list", ["keyword"=>$keyword, "page" => $books["page"]+1])  }}" class="btn btn-light mx-2 " data={ disable_with: "処理中..." }>
        次のページ
      </a>
    </h4>
  @endif
</div>
@endsection