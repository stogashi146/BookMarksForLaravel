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
      <div class="col-md-10 mt-3">
        <p class="mb-0">説明：</p>
        <p>{{ $book->description }}</p>
      </div>

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
              @if($read)
                <div class="d-block">
                  <a href="" class="btn btn-light shadow-sm book_show_onbtn" type= "button" data-toggle= "modal" data-target= "#read_modal">
                    <i class="fas fa-book-reader fa-2x text-dark"></i>
                    <p class="text-center">
                      {{ count($book -> reads) }}
                    </p>
                  </a>
                </div>

              @else
                <div class="d-block">
                  <a href="" class="btn btn-light shadow book_show_btn" type= "button" data-toggle= "modal" data-target= "#read_modal">
                    <i class="fas fa-book-reader fa-2x text-dark"></i>
                    <p class="text-center">
                      {{ count($book -> reads) }}
                    </p>
                  </a>
                </div>
              @endif

              <div class="modal fade" id="read_modal" tabindex= "-1" role= "dialog" aria-labelledby= "read_modal_label" aria-hidden= "true">
                <div class="modal-dialog modal-dialog-scrollable" role= "document">
                  <div class="modal-content">
                    <div class="modal-header read_modal_header">
                      <h4 class="modal-title" id="read_modal_centered_label">
                        レビュー
                      </h4>
                      <button class="close" type= "button" data-dismiss= "modal" aria-label= "Close">
                        <span aria-hidden= "true">
                          &times;
                        </span>
                      </button>
                    </div>
                    <div class="modal-body">
                      @if($read)
                        {{ Form::model($read, ["route" => ["read.update", $read->id]]) }}
                          <div class="form-group">
                            {{ Form::textarea("comment", null, ["class" => "form-control", "placeholder" => "レビュー無記入でも投稿できます。", "rows" => 5, "value" => $read -> comment]) }}
                          </div>
                          <div class="form-group" id="star-edit">
                            <!-- = f.hidden_field :rate, class: "form-control", id: :review_star -->
                          </div>
                          <div class="form-group">
                            <!-- = f.text_field :tag_list, value: book_read.tag_list.join(","), placeholder: "「,」区切りで複数のタグを追加できます", class:"form-control" -->
                          </div>
                          <div class="modal-footer bg-light px-5">
                            {{ Form::hidden('book', $book->id) }}
                            <!-- {{ Form::hidden('read', $read->id) }} -->
                            {{ Form::submit("編集する", ["class" => "btn btn-primary"]) }}
                            @method("PUT")
                          {{ Form::close() }}

                            <a class="btn btn-secondary" href="{{ route("read.destroy",["read"=> $read, "book" => $book]) }}" data: { disable_with: "送信中..." } 
                              onclick="event.preventDefault(); document.getElementById('read-destroy').submit();">
                              削除する
                            </a>
                            <form id="read-destroy" action="{{ route("read.destroy",["read"=> $read, "book" => $book]) }}" method="POST" style="display: none;">
                                @method("DELETE")
                                @csrf
                            </form>
                          </div>
                        <script>
                          $("#star-edit").empty();
                          $("#star-edit").raty({
                            size     : 36,
                            starOff: "#{asset_path('star-off.png')}",
                            starOn: "#{asset_path('star-on.png')}",
                            starHalf: "#{asset_path('star-half.png')}",
                            score: "#{book_read.rate}",
                            scoreName: "book_read[rate]",
                            half: false,
                          });
                        </script>

                      @else
                        {{ Form::open(["route" => "read.store"]) }}
                          <div class="form-group">
                            {{ Form::textarea("comment", null, ["class" => "form-control", "placeholder" => "レビュー無記入でも投稿できます。", "rows" => 5]) }}
                          </div>
                          <div class="form-group">
                            <!-- = f.hidden_field :rate, class: "form-control" -->
                          </div>
                          <div class="form-group">
                            <!-- = f.text_field :tag_list, value: book_read_new.tag_list.join(","), placeholder: "「,」区切りで複数のタグを追加できます", class:"form-control" -->
                          </div>
                          {{ Form::hidden('read', $read) }}
                          {{ Form::hidden('book', $book->id) }}
                          <div class="modal-footer bg-light px-5">
                            {{ Form::submit("投稿する", ["class" => "btn btn-primary"])}}
                          </div>
                        {{ Form::close() }}
                      @endif
                    </div>
                  </div>
                </div>
              </div>

              <script>
                $('#star').raty({
                  size     : 36,
                  starOff: "#{asset_path('star-off.png')}",
                  starOn: "#{asset_path('star-on.png')}",
                  starHalf: "#{asset_path('star-half.png')}",
                  scoreName: "book_read[rate]",
                  half: false,
                });
              </script>
            </div>

            <!-- unread_btn  -->
            <div class="show_unread_icon">
              @if($unread)
                <div class="d-block">
                  <a class="unread_btn" href="{{ route("unread.destroy", ["unread" => $unread, "book" => $book]) }}" data: { disable_with: "送信中..." } 
                                              onclick="event.preventDefault(); document.getElementById('unread-destroy').submit();">
                    <div class="btn btn-light shadow-sm book_show_onbtn">
                      <i class="fas fa-plus-square fa-2x"></i>
                      <p class="text-center">
                        {{ count($book->unreads) }}
                      </p>
                    </div>
                  </a>
                  <form id="unread-destroy" action="{{ route("unread.destroy", ["unread" => $unread, "book" => $book]) }}" method="post" style="display: none;">
                      @method("DELETE")
                      @csrf
                  </form>
                </div>

              @else
                <div class="d-block">
                  <a class="unread_btn" href="{{ route("unread.store",["book" => $book]) }}" data: { disable_with: "送信中..." } 
                                              onclick="event.preventDefault(); document.getElementById('unread-create').submit();">
                    <div class="btn btn-light shadow book_show_btn shadow-sm">
                      <i class="fas fa-plus-square fa-2x"></i>
                      <p class="text-center">
                        {{ count($book->unreads) }}
                      </p>
                    </div>
                  </a>
                  <form id="unread-create" action="{{ route("unread.store",["book" => $book]) }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              @endif
            </div>
          </div>

        <!-- 未ログイン  -->
        @else
          <div class="d-flex flex-row align-bottom mt-5">
            <div class="d-block">
              <a href="{{ route("login") }}" class="read_btn">
                <div class="btn btn-light shadow book_show_btn">
                  <i class="fas fa-book-reader fa-2x"></i>
                  <p class="text-center">
                    {{ count($book->reads) }}
                  </p>
                </div>
              </a>
            </div>
            <div class="d-block">
              <a href="{{ route("login") }}" class="unread_btn">
                <div class="btn btn-light shadow book_show_btn shadow">
                  <i class="i fas fa-plus-square fa-2x"></i>
                  <p class="text-center">
                    {{ count($book->unreads) }}
                  </p>
                </div>
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="bg-light text-center py-3 mt-3">
        <h3>{{ count($book -> reads)}}件のレビュー </h3>
      </div>      
    </div>
  </div>

  <div class="row">
    @foreach($reads as $review)
      <div class="col-md-6">
        <div class="bg-white my-3 p-3">
          <div class="d-flex flex-row">
            <div class="flex-column">
              <div class="d-flex flex-row mb-1">
                <a href="{{ route("user.reads",["user" => $review -> user, "sort" => "default"]) }}">
                  @if($review -> user -> image == "noimage.jpg")
                    <img src="{{asset('images/noimage.jpg')}}" class="rounded-circle" width="50px" height="50px">
                  @else
                    <img src="{{asset('storage/images/'.$review -> user->image)}}" class="rounded-circle" width="50px" height="50px">
                  @endif
                </a>
                <strong class="flex-column ml-3">
                  <a href="{{ route("user.reads",["user" => $review -> user, "sort" => "default"]) }}" class="text-dark">{{ $review -> user -> name}}の感想・レビュー</a>  
                  <!-- <small class="text-muted">
                    = time_ago_in_words(review.created_at).upcase
                  </small> -->
                </strong>
              </div>
              <div class="ml-1">
                <div id="rate_".{{$review->id}} class="my-1"></div>

                <div class="mt-1 mr-3">
                  <!-- = simple_format(review.comment.truncate(50))
                  - if review.comment.size > 50
                    .small = link_to "続きを読む", book_book_read_path(review.book_id, review.id, user: review.user) -->
                  <p>{{ $review -> comment }}</p>
                </div>
                <div class="mt-2">
                  <!-- - if review.tag_list.present?
                    br
                    i.fas.fa-tags
                    - review.tag_counts_on(:tags).limit(5).each do |tag|
                      = link_to "##{tag.name}(#{BookRead.tags_count(tag.name)})", tag_path(tag.name), class:"badge badge-pill badge-light p-2 mt-3 mx-2"
                    - if review.tag_list.count > 5
                      span
                        = link_to "....", book_book_read_path(review.book_id, review, user: review.user), class:"text-secondary" -->
                </div>
              </div>
            </div>
          </div>

          <!-- hr
          .d-flex.flex-row
            span id="favorite_btn_#{review.id}"
              = render "read_favorites/favorite_btn", review: review

            .badge.badge-pill.badge-light.pt-2
              h6
                = link_to book_book_read_path(review.book_id, review, user: review.user), class:"comment_btn text-secondary" do
                  i.fa.fa-comments コメント#{review.read_comments.count} -->
        </div>
      </div>
    @endforeach
  </div>

  <script>
    $("#rate_#{review.id}").empty();
    $("#rate_#{review.id}").raty({
      size: 10,
      starOff: "#{asset_path('star-off.png')}",
      starOn: "#{asset_path('star-on.png')}",
      starHalf: "#{asset_path('star-half.png')}",
      half: true,
      readOnly: true,
      score: "#{review.rate}",
    });
  </script>
</div>

<script>
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
</script>

@endsection