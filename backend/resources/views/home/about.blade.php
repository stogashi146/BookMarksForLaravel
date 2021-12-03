@extends("layouts/layout")

@section("content")
<div class="about_bg">
  <div class="container-fluid">
    <div class="row about_vw">
      <div class="col-md-5 col-sm-12 d-flex flex-column">
        <div class="flex-item text-center">
          <h1 class="about_h1_item">
            表紙買いを
            <br />
            <div class="ml-4">
              どこでも
            </div>
          </h1>
        </div>
        <div class="flex-item text-center mt-5">
          <!-- <%= link_to "今すぐ本を探す", books_path(keyword: "本", page: rand(100, class:"btn about_find_book p-3" %> -->
            <a href="{{ route("book.index", ["keyword"=> "本", "page" => 1]) }}" class="btn about_find_book p-3">
            今すぐ本を探す
          </a>
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="about_slide_box">
          @foreach($books as $book)
            <img src=" {{ $book -> image_url }}" class = "mx-3">
          @endforeach
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 bg-white py-5">
      <div class="col-md-5 mx-auto">
        <h1 class="about_what_h1 text-center pb-3">
          BookMarksについて
        </h1>
        <div class="text-center mt-3">
          <span>
            インターネットで
          </span><span class="about_what_span p-1 mx-1">
            表紙買い
          </span><span>
            ができるサービス
          </span></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 py-5 about_what_text">
      <div class="col-md-7 mx-auto">
        <p class="text-center">
          BookMarksはインターネットで表紙買いができるサービスです。
        </p>
        <p class="text-center">
          また、
          <!-- <%= link_to "ログイン", new_user_session_path %> -->
          することでコミュニティを広げることができます。
        </p>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12 col-sm-12 d-inline-block">
      <div class="col-md-3 col-sm-12 d-inline-block text-center align-top">
        <i class="fas fa-book-open fa-5x rounded-circle bg-white p-5 about_intro_orangeicon">
        </i>
        <div class="col-md-10 mx-auto">
          <p class="about_intro_orangetext mt-3">
            本を見つける
          </p>
          <p>「本を探す」から好きな本を見つけよう
          </p>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 d-inline-block text-center align-top">
        <i class="fas fa-bell fa-5x rounded-circle bg-white p-5 about_intro_orangeicon">
        </i>
        <div class="col-md-11 mx-auto">
          <p class="about_intro_orangetext mt-3">
            発売日に通知を受け取る
          </p>
          <p>
            <span>
              読みたいリスト
              <i class="far fa-plus-square pr-1"></i>
              に入れた本は、発売前にメール通知、
              発売当日には通知でお知らせします！
            </span>
          </p>
          <small>※メール通知は、プロフィール編集から設定できます
          </small>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 d-inline-block text-center align-top">
        <i class="fas fa-book-reader fa-5x rounded-circle bg-white p-5 about_intro_blueicon">
        </i>
        <div class="col-md-10 mx-auto">
          <p class="about_intro_bluetext mt-3">
            レビューする
          </p>
          <p>
          </p>
          <span>
            読んだ本は読んだリスト
            <i class="fas fa-book-reader px-1">
            </i>に追加して、レビューしよう
          </span>
        </div>
      </div>
      <div class="col-md-2 col-sm-12 d-inline-block text-center align-top">
        <i class="fas fa-comments fa-5x rounded-circle bg-white p-5 about_intro_blueicon">
        </i>
        <div class="col-md-10 mx-auto">
          <p class="about_intro_bluetext mt-3">
            交流する
          </p>
          <p>
            フォローしてフォロユーザーの読書記録を確認しよう
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="text-right">
    <!-- Rakuten Web Services Attribution Snippet FROM HERE -->
    <a href="https://webservice.rakuten.co.jp/" target="_blank">
      <img alt="楽天ウェブサービスセンター" border="0" height="21" src="https://webservice.rakuten.co.jp/img/credit/200709/credit_22121.gif" title="楽天ウェブサービスセンター" width="221" />
    </a><!-- Rakuten Web Services Attribution Snippet TO HERE -->
  </div>
</div>
<script>
  $('.about_slide_box').slick({
    autoplay:true, //自動スクロール
    autoplaySpeed:0, //自動スクロールの切り替え時間
    speed: 4500, //スクロール速度
    cssEase: "linear", //スライドの切り替えを等速にする
    slidesToShow: 3, //表示するスライドの数
    swipe: false, //ユーザー操作禁止
    arrows: false, //矢印非表示
    pauseOnFocus: false, //要素をクリックでアクティブしたときに、スライドを停止させるか
    pauseOnHover: false, //マウスホバーしたときに、スライドを停止させるか
  });
</script>
@endsection