@extends("layouts/layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="bg-white text-center border shadow py-3">
        <h3>プロフィール編集</h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center mt-4">
      <div class="bg-white py-5">
        {{ Form::model($user, ["route" => ["user.update", $user->id], "enctype" => "multipart/form-data"]) }}
          <div class="d-inline-flex user_edit_flex">
            <div class="d-block.mr-3 user_edit_jacket">
              @if($user->image == "noimage.jpg")
                <img src="{{asset('images/noimage.jpg')}}" class="rounded-circle shadow-sm ml-4" width="180px" height="180px">
              @else
                <img src="{{asset('storage/images/'.$user->image)}}" class="rounded-circle shadow-sm ml-4" width="180px" height="180px">
              @endif
              <br>
              <small>
                {{ Form::file("image") }}
              </small>
            </div>
            <div class="d-block user_edit_input">
              <div class="form-group">
                <div class="text-left">
                  {{ Form::label("name","ニックネーム"), ["class" => "mr-auto"] }}
                  {{ Form::text("name", $user -> name), ["class" => "form-control"] }}
                </div>
              </div>
              <div class="form-group">
                <div class="text-left">
                  {{ Form::label("email","メールアドレス"), ["class" => "mr-auto"] }}
                  {{ Form::text("email", $user -> email), ["class" => "form-control"] }}
                </div>
              </div>
              <div class="form-group">
                <div class="text-left">
                  {{ Form::label("introduction","自己紹介"), ["class" => "mr-auto"] }}
                  {{ Form::text("introduction", $user -> introduction), ["class" => "form-control"] }}
                </div>
              </div>
              <!-- .form-check.form-check-inline
                - if @user.email == "guest@book-marks.net"
                  = f.check_box :is_mail_send, class:"form-check-input", disabled: true
                - else
                  - if @user.is_mail_send
                    = f.check_box :is_mail_send, checked_value: true, unchecked_value: false, checked: true, class:"form-check-input"
                  - else
                    = f.check_box :is_mail_send, checked_value: true, unchecked_value: false, class:"form-check-input"

                = f.label :is_mail_send, "発売前日にメールを受け取る", class:"form-check-label"

              .form
                small
                  | ※読みたいリストに入れた本が発売前日に通知されます。 -->

              <div class=".form-group.mt-3">
                @method("PUT")
                {{ Form::submit("変更を保存する", ["class" => "btn btn-success"])}}
                {{ Form::close() }}
                <a href="{{ route("user.show", ["user" => \Auth::user()->id]) }}" class="btn btn-secondary ml-3">
                  戻る
                </a>
              </div>
              <!-- .form-group.mt-5
                small
                  = link_to "退会する", user_cancel_path(current_user), local: true, class:"btn btn-danger btn-sm" -->
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
