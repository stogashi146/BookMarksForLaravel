@extends("layouts/layout")

@section("content")

<div class="container show">
  <div class="row bg-white p-3">
    <div class="col-md-4">
      <a href="{{ $book->url }}">
        <img src="{{ $book->image_url }}" alt="" width = '100%' height = '100%'>
      </a>
    </div>
    <div class="col-md-8 mr-auto">
      <h3>
        {{ $book->title }}
      </h3>
      <div class="mt-3">
        <p class="mb-0">
          著者：
          {{ $book->author }}
        </p>
        <p class="mb-0">
          出版社：
          {{ $book->publisher_name }}
        </p>
        <p class="mb-0">
          発売日：
          {{ $book->sales_date }}
        </p>
        <div id="avg_rate_#{@book.id}"></div>
      </div>
      <a href="{{ $book->url }}" class="btn btn-danger text-white mt-3">
        楽天ブックスで購入する
      </a>

      <!-- - if @tags.present?
        <br>
        <i class="fas fa-tags"></i>
        - @tags.each do |tag|
          = link_to "##{tag.name}(#{BookRead.tags_count(tag.name)})", tag_path(tag.name), class:"badge badge-pill badge-light p-2 mt-3 mx-2"

      - else
        <div class="mt-3">
          <i class="fas fa-tags"></i>
          <span>登録されているタグはありません</span>
        </div> -->
      <div class="d-flex flex-column">
        @if(\Auth::user())
          <div class="d-flex flex-row align-bottom mt-5">
            <div class="show_read_icon">
              = render "read", book: @book, book_read: @book_read, book_read_new: @book_read_new
            </div>
            <div class="show_unread_icon">
              = render "unread", book: @book
            </div>
          </div>

        @else
          <div class="d-flex flex-row align-bottom mt-5">
            <div class="d-block">
              <a href="{{ route("login") }}" class="read_btn">
                <div class="btn btn-light shadow book_show_btn">
                  <i class="fas fa-book-reader fa-2x"></i>
                  <p class="text-center">
                    <!-- = "#{@book.book_reads.count}" -->
                  </p>
                </div>
              </a>
            </div>
            <div class="d-block">
              <a href="{{ route("login") }}" class="unread_btn">
                <div class="btn btn-light shadow book_show_btn shadow">
                  <i class="i fas fa-plus-square fa-2x"></i>
                  <p class="text-center">
                    <!-- = "#{@book.book_unreads.count}" -->
                  </p>
                </div>
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
  <!-- = render "review", reviews: @reviews -->
</div>

<!-- <script>
  $("#avg_rate_#{@book.id}").empty();
  $("#avg_rate_#{@book.id}").raty({
    size: 10,
    starOff: "#{asset_path('star-off.png')}",
    starOn: "#{asset_path('star-on.png')}",
    starHalf: "#{asset_path('star-half.png')}",
    half: true,
    readOnly: true,
    score: "#{Book.reviews_avg(@book)}",
  });
</script> -->

@endsection