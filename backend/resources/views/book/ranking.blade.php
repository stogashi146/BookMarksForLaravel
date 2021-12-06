@extends("layouts/layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="bg-white text-center shadow border py-3">
        <h3>ランキング</h3>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-md-4">
      <table class="table">
        <tr class="thead-light">
          <th>ジャンル</th>
        </tr>
        <div class="text-primary">
          @foreach($ranking_sort as $key => $value)
            <tr class="bg-white">
              <td>
                <a href="{{ route("book.ranking", ["keyword" => "本", "page" => 1,"genre" => $key, "sort" => "sort"])}}">{{ $key }}</a>
              </td>
            </tr>
          @endforeach
        </div>
      </table>

      <table class="table table-hover">
        <tr class="thead-light">
          <th>BookMark内ランキング</th>
        </tr>
        <div class="text-primary">
          <tr class="mt-3 bg-white">
            <td>
              <a href="{{ route("book.ranking", ["read_ranking" => "read_ranking"]) }}">
                読んだ
              </a>
            </td>
          </tr>
          <tr class="bg-white">
            <td>
              <a href="{{ route("book.ranking", ["unread_ranking" => "unread_ranking"]) }}">
                読みたい
              </a>
            </td>
          </tr>
        </div>
      </table>
    </div>
    <div class="col-md-8 ml-auto">

@if(isset($books["Items"]))
  @foreach($books["Items"] as $book)
    <div class="card flex-md-row mb-4 shadow-sm">
      <div class="card-body d-flex flex-column align-items-start w-100 h-25">
        <h4>{{ $count }}位</h4>
        <h5>
          <a class="text-dark" href="{{ route("book.store",["book"=> App\Book::book_exists($book)]) }}" onclick="event.preventDefault();
                                                                              document.getElementById('book-create-{{$book["isbn"]}}').submit();">
            {{ $book["title"] }}
          </a>
          <form id="book-create-{{$book["isbn"]}}" action="{{ route("book.store",["book"=> App\Book::book_exists($book)]) }}" method="POST" style="display: none;">
              @csrf
          </form>
        </h5>
        <!-- div id="rate_#{book_rank.id}" class="my-1" -->
        <p class="mb-0">
          著者：{{ $book["author"] }}
        </p>
        <p class="mb-0">
          出版社：{{ $book["publisherName"] }}
        </p>
        <p class="mb-0">
          "発売日：{{ $book["salesDate"] }}
        </p>

        <!-- <div class="d-flex flex-row mt-auto">
          <div class="d-block">
            <div class="badge badge-light text-dark shadow-sm ranking_item_btn pt-2" id="ranking_item_activebtn">
              <i class="fas fa-book-reader fa-2x"></i>
              <p class="text-center">
                = "#{book_rank.book_reads.count}"
              </p>  
            </div>
          </div> -->

          <!-- .d-block
            = link_to book_path(book_rank), local: true do
              div class="badge badge-light text-dark shadow-sm ranking_item_btn pt-2 #{"ranking_item_activebtn" if user_signed_in? && current_user.book_unreads.find_by(book_id: book_rank) }"
                i.fas.fa-plus-square.fa-2x
                p.text-center
                  = "#{book_rank.book_unreads.count}" -->
        <!-- </div> -->
      </div>
      <!-- = link_to book_path(book_rank.id), local: true, class:"flex-auto text-right" do -->
        <!-- = image_tag book_rank.image_url.chomp("?_ex=200x200"), :width => '220px', :height => '100%', class:"text-right ranking_book_jacket" -->

      <a class="flex-auto text-right" href="{{ route("book.store",["book"=> App\Book::book_exists($book)]) }}" onclick="event.preventDefault();
                                                                            document.getElementById('book-create-{{$book["isbn"]}}').submit();">
        <img src="{{ str_replace("?_ex=200x200","",$book["largeImageUrl"]) }}" alt="" width="220px" height="100%" class="text-right ranking_book_jacket">
      </a>

      <form id="book-create-{{$book["isbn"]}}" action="{{ route("book.store",["book"=> App\Book::book_exists($book)]) }}" method="POST" style="display: none;">
          @csrf
      </form>

      <!-- javascript:
        $("#rate_#{book_rank.id}").empty();
        $("#rate_#{book_rank.id}").raty({
          size: 20,
          starOff: "#{asset_path('star-off.png')}",
          starOn: "#{asset_path('star-on.png')}",
          starHalf: "#{asset_path('star-half.png')}",
          half: true,
          readOnly: true,
          score: "#{Book.reviews_avg(book_rank)}",
        }); -->
    </div>

    
    {{ csrf_field($count += 1 ) }}
  @endforeach
@else
  @foreach($books as $book)
    <div class="card flex-md-row mb-4 shadow-sm">
      <div class="card-body d-flex flex-column align-items-start w-100">
        <h4></h4>
        <h4>{{ $count }}位</h4>
        <h5>
            <a class="text-dark" href="{{ route("book.show", ["book" => $book]) }}">
              {{ $book["title"] }}
            </a>
        </h5>
        <!-- div id="rate_#{book_rank.id}" class="my-1" -->
        <p class="mb-0">
          著者：{{ $book["author"] }}
        </p>
        <p class="mb-0">
          出版社：{{ $book["publisher_name"] }}
        </p>
        <p class="mb-0">
          "発売日：{{ $book["sales_date"] }}
        </p>

        <div class="d-flex flex-row mt-auto">
          <div class="d-block">
            <div class="badge badge-light text-dark shadow-sm ranking_item_btn pt-2" id="ranking_item_activebtn">
              <i class="fas fa-book-reader fa-2x"></i>
              <p class="text-center">
                {{ $book -> reads_count }}
              </p>
            </div>
          </div>
          <div class="d-block">
            <div class="badge badge-light text-dark shadow-sm ranking_item_btn pt-2" id="ranking_item_activebtn">
              <i class="fas fa-plus-square fa-2x"></i>
              <p class="text-center">
                {{ $book -> unreads_count }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-4">
        <a class="text-dark" href="{{ route("book.show", ["book" => $book]) }}" class="text-right">
          <img src="{{ $book -> image_url }}" alt="" width="220px" height=100% class:"text-right ranking_book_jacket">
        </a>
      </div>
    </div>
    {{ csrf_field($count += 1 ) }}
  @endforeach
@endif
</div>

@endsection