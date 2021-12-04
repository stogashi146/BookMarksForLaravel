@extends("layouts/layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-10 mx-auto">
        <div class="bg-white text-center shadow border py-3">
          <h3>入力内容の確認</h3>
          <hr>
          <p>入力内容を確認の上、入力内容確認ボタンを押下してください。</p>

          <div class="d-block">
              <div class="form-group">
                <div class="text-left">
                  {{ Form::open(["route" => "contact.confirm", "class" => "my-2 my-lg-0"]) }}
                    <div class="form-group px-5 py-2">
                      {{ Form::label("email","メールアドレス" , ["class" => "h4"]) }}
                      <strong class="badge badge-danger">必須</strong>
                      {{ Form::text("email", null, ["class" => "form-control", "placeholder" => "sample1@sample.com", "required" => "true"]) }}
                    </div>
                    <div class="form-group px-5 py-2">
                      {{ Form::label("category","お問い合わせの種類", ["class" => "h4"]) }}
                      <span class="badge badge-danger">必須</span>
                      <div>
                        {{ Form::select("category", $categories, ["class" => "form-select"]) }}
                      </div>
                    </div>
                    <div class="form-group px-5">
                    {{ Form::label("content","ご意見、ご質問", ["class" => "h4"]) }}
                    <span class="badge badge-danger">必須</span>
                      {{ Form::textarea("content", null, ["class" => "form-control", "required" => "true"]) }}
                    </div>
                    <div class="p-3 text-center">
                      {{ Form::submit("入力内容を確認する", ["class" => "btn btn-success"])}}
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
