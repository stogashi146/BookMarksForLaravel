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
            @if (\Auth::user()->id == $user->id )
              <a href="{{ route("user.edit", ["user" => \Auth::user()->id]) }}" class="user_edit_btn btn btn-outline-secondary px-2 mr-2">
                <i class="fas fa-cog mx-1"></i>
                <span>プロフィール編集</span>
              </a>
            @else
              <div class="follow_ajax_btn">
                @if($follow)
                  <a class="btn btn-sm btn-secondary px-3 align-items-center" href="{{ route("relationship.destroy",["user" => $user]) }}" data: { disable_with: "送信中..." } 
                                              onclick="event.preventDefault(); document.getElementById('follow-destroy').submit();">
                    <i class="fas fa-user-check mx-1"></i>
                    <span>フォロー中</span>
                  </a>
                  <form id="follow-destroy" action="{{ route("relationship.destroy",["user" => $user]) }}" method="POST" style="display: none;">
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
              <a href="{{ route("user.reads", ["user" => $user, "sort" => "default"]) }}" class="btn btn-light user_show_btn">
                  <i class="fas fa-book-reader fa-2x text-dark"></i>
                  <p class="text-center">
                    {{ count($user -> reads) }}
                  </p>
              </a>
            </div>
            <div class="d-block user_show_btns">
              <a href="{{ route("user.unreads", ["user" => $user, "sort" => "default"]) }}" class="btn btn-light user_show_btn" id="unread_btn">
                <i class="far fa-plus-square fa-2x"></i>
                <p class="text-center">
                {{ count($user -> unreads) }}
                </p>
              </a>
            </div>
            <div class="d-block user_show_btns">
              <a href="{{ route("user.following", ["user" => $user, "sort" => "default"]) }}" class="btn btn-light user_show_btn pt-2 read_btn_active" id="follow_btn">
                <small>フォロー</small>
                <p class="text-center">
                  {{ count($followings_users) }}
                </p>
              </a>
            </div>
            <div class="d-block user_show_btns">
              <a href="{{ route("user.followers", ["user" => $user, "sort" => "default"]) }}" class="btn btn-light user_show_btn pt-2" id="follower_btn">
                <small>フォロワー</small>
                <p class="text-center">
                  {{ count($followers_users) }}
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="user_main_item">
    <div class="col-md-3 col-sm-3 offset-10 px-5">
        <div class="row text-right">
          <div class="drop-down">
            <button class="btn btn-light border dropdown-toggle" id="dropdownMenu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-filter"></i>ソート
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
              @foreach($follow_sort as $key => $value)
                <a href="{{ route("user.following", ["user" => $user ->id ,"sort" => $key]) }}" class="dropdown-item">{{ $value }}</a>
              @endforeach
            </div>
          </div>
        </div>
    </div>

    @foreach($followings as $follow_user)
      <div class="col-md-4 mt-2">
        <div class="bg-white p-3 border w-100 h-100">
          <div class="d-flex">
            <a href=" {{ route("user.reads", ["user" => $follow_user -> followed_id, "sort" => "default"]) }}">
              @if($follow_user->image == "noimage.jpg")
                <img src="{{asset('images/noimage.jpg')}}" class="rounded-circle shadow-sm mr-4" width="80px" height="80px">
              @else
                <img src="{{asset('storage/images/'.$follow_user->image)}}" class="rounded-circle shadow-sm mr-4" width="80px" height="80px">
              @endif
            </a>
            <div class="d-flex flex-column">
              <strong class="d-flex flex-row">
              <a href=" {{ route("user.reads", ["user" => $follow_user -> followed_id, "sort" => "default" ]) }}" class="text-dark mr-3">
                {{ $follow_user -> name }}
              </a>
              </strong>
              <small class="mt-3">
                {{ $follow_user -> introduction }}
              </small>
            </div>
          </div>

          <div class="d-flex mt-5">
            <div class="flex-column w-25 text-center">
              <i class="fas fa-book-reader fa-2x text-dark"></i>
              <p class="text-center">
                {{ $follow_user -> reads_count }}
              </p>
            </div>
            <div class="flex-column w-25 text-center">
              <i class="far fa-plus-square fa-2x text-dark"></i>
              <p class="text-center">
                {{ $follow_user -> unreads_count }}
              </p>
            </div>
            <div class="flex-column w-25 text-center mt-2">
              <small>フォロー</small>
              <p class="text-center">
                {{ $follow_user -> follower_count }}
              </p>
            </div>
            <div class="flex-column w-25 text-center mt-2">
              <small>フォロワー</small>
              <p class="text-center">
                {{ $follow_user -> followed_count }}
              </p>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection