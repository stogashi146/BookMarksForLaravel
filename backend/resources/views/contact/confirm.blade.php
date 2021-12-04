@extends("layouts/layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-10 mx-auto">
        <div class="bg-white text-center shadow border py-3">
          <h3>入力内容の確認</h3>
          <hr>
          <p>下記フォームに入力事項を入力の上、送信ボタンを押下してください。</p>

          <div class="d-block">
              <div class="form-group">
                <div class="text-left">
                  {{ Form::open(["route" => "contact.send", "class" => "my-2 my-lg-0"]) }}
                    <div class="form-group px-5 py-2">
                      {{ Form::label("email","メールアドレス" , ["class" => "h4"]) }}
                      {{ Form::text("email", $email, ["class" => "form-control", 'readonly']) }}
                    </div>
                    <div class="form-group px-5 py-2">
                      {{ Form::label("category","お問い合わせの種類", ["class" => "h4"]) }}
                      <div>
                        {{ Form::text("category", $category, ["class" => "form-control", 'readonly']) }}
                      </div>
                    </div>
                    <div class="form-group px-5 py-2">
                    {{ Form::label("content","ご意見、ご質問", ["class" => "h4"]) }}
                      {{ Form::textarea("content", $content, ["class" => "form-control", 'readonly']) }}
                    </div>
                    <div class="p-3 text-center">
                      {{ Form::submit("送信", ["class" => "btn btn-success"])}}
                      <p onClick="history.back()" class="btn btn-danger ml-5 mt-3">修正</p>
                    </div>
                    @method("GET")
                  {{ Form::close() }}
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
