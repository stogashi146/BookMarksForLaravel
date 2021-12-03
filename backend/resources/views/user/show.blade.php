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
                @if($follow)
                  <a class="btn btn-sm btn-secondary px-3 align-items-center" href="{{ route("relationship.destory",["user" => $user]) }}" data: { disable_with: "送信中..." } 
                                              onclick="event.preventDefault(); document.getElementById('follow-destory').submit();">
                    <i class="fas fa-user-check mx-1"></i>
                    <span>フォロー中</span>
                  </a>
                  <form id="follow-destory" action="{{ route("relationship.destory",["user" => $user]) }}" method="POST" style="display: none;">
                      @method("DELETE")
                      @csrf
                  </form>
                @else
                  <a class="btn btn-sm btn-light btn-outline-secondary px-3" href="{{ route("relationship.store",["user" => $user]) }}" data: { disable_with: "送信中..." } 
                                              onclick="event.preventDefault(); document.getElementById('follow-create').submit();">
                    <i class="fas fa-user-plus mx-1"></i>
                    <span>フォロー</span>
                  </a>
                  <form id="follow-create" action="{{ route("relationship.store",["user" => $user]) }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                @endif
              </div>
            @endif
          </div>
        </div>
        
        <div class="hrmb-0 mt-5"></div>
        
        <div class="row">
          <div class="col-md-12 d-inline-flex">
            <div class="d-block user_show_btns">
              <div class="btn btn-light user_show_btn read_btn_active#read_btn">
                <i class="fasfa-book-reader fa-2x text-dark"></i>
                <p class="text-center">
                  = "#{@book_reads.count}"
                </p>
              </div>
            </div>
            <div class="d-block user_show_btns">
              <div class="btn btn-light user_show_btn" id="unread_btn">
                <i class="farfa-plus-square fa-2x"></i>
                <p class="text-center">
                  = "#{@book_unreads.count}"
                </p>
              </div>
            </div>
            <div class="d-block user_show_btns">
              <div class="btn btn-light user_show_btn pt-2" id="follow_btn">
                <small>フォロー</small>
                <p class="text-center">
                  = "#{@user.followings.count}"
                </p>
              </div>
            </div>
            <div class="d-block user_show_btns">
              <div class="btn btn-light user_show_btn pt-2" id="follower_btn">
                <small>フォロワー</small>
                <p class="text-center">
                  = "#{@user.followers.count}"
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="user_main_item">
    = render "read", book_reads: @book_reads
  </div>
</div>

<!-- <script>
  $('#read_btn').on('click', function() {
    $("#user_main_item").html("#{j(render "read", book_reads: @book_reads)}");
    $('.user_show_btn').removeClass('read_btn_active');
    $(this).addClass('read_btn_active');
  });

  $('#unread_btn').on('click', function() {
    $("#user_main_item").html("#{j(render "unread", book_unreads: @book_unreads)}");
    $('.user_show_btn').removeClass('read_btn_active');
    $(this).addClass('read_btn_active');
  });

  $('#follow_btn').on('click', function() {
    $("#user_main_item").html("#{j(render "follow", user: @user)}");
    $('.user_show_btn').removeClass('read_btn_active');
    $(this).addClass('read_btn_active');
  });

  $('#follower_btn').on('click', function() {
    $("#user_main_item").html("#{j(render "follower", user: @user)}");
    $('.user_show_btn').removeClass('read_btn_active');
    $(this).addClass('read_btn_active');
  });
</script> -->

@endsection