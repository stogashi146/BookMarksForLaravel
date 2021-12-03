@extends("layouts/layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="bg-white shadow border pt-1">
        <div class="row mt-5">
          <div class="col-md-8 col-sm-8">
            <div class="d-inline-flex align-items-center">
              @if($user->image == "noimage.jpg")
                <img src="{{asset('images/noimage.jpg')}}" class="rounded-circle shadow-sm ml-4" width="130px" height="130px">
              @else
                <img src="{{asset('storage/images/'.$user->image)}}" class="rounded-circle shadow-sm ml-4" width="130px" height="130px">
              @endif
              <div class="d-block ml-5">
                <h3 class="user_show_name">
                  {{ $user->name }}
                </h3>
                <p>
                  {{ $user->introduction }}
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-items-center justify-content-end">
            @if (\Auth::user() == $user )
              <a href="{{ route("user.edit", ["user" => \Auth::user()->id]) }}" class="user_edit_btn btn btn-outline-secondary px-2 mr-2">
                <i class="fas fa-cog mx-1"></i>
                <span>プロフィール編集</span>
              </a>
            @else
              <div class="follow_ajax_btn">
                <!-- = render "relationships/follow_btn", user: @user -->
              </div>
            @endif
          </div>
        </div>
        
        <div class="hrmb-0 mt-5"></div>
        <div class="row">
          <div class="col-md-12 d-inline-flex">
            <div class="d-block user_show_btns">
              <a href="{{ route("user.reads", ["user" => $user]) }}" class="btn btn-light user_show_btn">
                  <i class="fas fa-book-reader fa-2x text-dark"></i>
                  <p class="text-center">
                    {{ count($user -> reads) }}
                  </p>
              </a>
            </div>
            <div class="d-block user_show_btns">
              <a href="{{ route("user.unreads", ["user" => $user]) }}" class="btn btn-light user_show_btn read_btn_active" id="unread_btn">
                <i class="far fa-plus-square fa-2x"></i>
                <p class="text-center">
                {{ count($user -> unreads) }}
                </p>
              </a>
            </div>
            <div class="d-block user_show_btns">
              <a href="{{ route("user.following", ["user" => $user]) }}" class="btn btn-light user_show_btn pt-2" id="follow_btn">
                <small>フォロー</small>
                <p class="text-center">
                  <!-- = "#{@user.followings.count}" -->
                </p>
              </a>
            </div>
            <div class="d-block user_show_btns">
              <a href="{{ route("user.followers", ["user" => $user]) }}" class="btn btn-light user_show_btn pt-2" id="follower_btn">
                <small>フォロワー</small>
                <p class="text-center">
                  <!-- = "#{@user.followers.count}" -->
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="user_main_item">
    <div class="col-md-12 col-sm-12 mt-4">
      <div class="row">
        @foreach($user -> unreads as $unread)
          <div class="col-md-6 col-sm-10 h-100 w-100">
            <div class="card flex-row mb-4 shadow border h-md-250 user_show_cardbody">
              <div class="card-body d-flex flex-column align-items-start">
                <strong>
                  <a href="{{ route("book.show", ["book" => $unread -> book]) }}">{{ $unread -> book -> title }}</a>
                </strong>
                <!-- div id="rate_#{book_read.id}" class="my-1" -->
                <p class="mb-0 small">
                  著者：{{ $unread -> book -> author  }}
                </p>
                <p class="mb-0small">
                  出版社：{{ $unread -> book -> publisher_name }}
                </p>
                <p class="mb-0 small">
                  発売日：{{ $unread -> book -> sales_date }}
                </p>
                  <!-- strong
                    = simple_format(book_read.comment.truncate(30))
                    - if book_read.comment.size > 30
                      small
                        = link_to "続きを読む", book_book_read_path(book_read.book_id,book_read, user: book_read.user_id) -->

                <div class="d-inline-flex btn-group btn-group-md mb-2">
                  <div class="badge badge-light text-dark shadow-sm align-items-end p-2">
                    <i class="fas fa-book-reader fa-2x text-dark pr-1"></i>
                    <span class="text-center">
                      {{ count($unread -> book -> reads) }}
                    </span>
                  </div>
                  <div class="badge badge-light text-dark shadow-sm align-items-end p-2">
                    <i class="far fa-plus-square fa-2x text-dark pr-1"></i>
                    <span class="text-center">
                      {{ count($unread -> book -> unreads) }}
                    </span>
                  </div>
                </div>

                <!-- .d-flex.flex-row.mt-auto
                  span id="favorite_btn_#{book_read.id}"
                    = render "read_favorites/favorite_btn", review: book_read

                  .badge.badge-pill.badge-light.pt-2
                    h6
                      = link_to book_book_read_path(book_read.book_id, book_read.id, user: book_read.user_id), class:"text-secondary" do
                        i.fa.fa-comment コメント#{book_read.read_comments.count}

                small.align-self-end
                  = book_read.created_at.strftime('%Y/%m/%d') -->
              </div>
              <a href="{{ route("book.show", ["book" => $unread -> book]) }}" class="flex-auto text-right my-auto">
                <img src="{{ $unread -> book -> image_url}}" class="user_show_jacket" width="245px" height="355px">
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection