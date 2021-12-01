<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='csrf-token' content='{{ csrf_token() }}'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>BookMarks</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://kit.fontawesome.com/7b10f1e4cc.js" crossorigin="anonymous"></script>
        <script src='{{ asset("js/app.js") }}' defer></script>
    </head>
    <body>
        <header class="sticky-top bg-white">
            <div class="container-fluid">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a href="{{ route("about") }}">
                            <img src="{{ asset('images/logo.png')}}" height="60" class:"navbar-brand">
                        </a>
                        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <form class="form-inline my-2 my-lg-0" action="/books" accept-charset="UTF-8" method="get">
                                <input required="required" class="form-control mr-sm-2" type="text" name="keyword" id="keyword">
                                <input type="submit" name="commit" value="検索" class="btn btn-sm btn-secondary m-0 ml-sm-0" data-disable-with="検索">
                            </form>
                            <ul class="navbar-nav ml-auto">
                            @if(\Auth::user())
                                <li class="nav-item active mr-3">
                                    <a class="header_find_book p-3" href="{{ route("books.list", ["keyword"=> "本", "page" => 1]) }}">本を探す</a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="nav-link" href="{{ route("user.show", ["user"=>\Auth::user()]) }}">
                                        <i class="fas fa-user fa-fw"></i>
                                        <span>マイページ</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-3">
                                    <a class="nav-link" href="{{-- route("timeline.list") --}}">
                                        <i class="fa fa-tasks"></i>
                                        <span>タイムライン</span>
                                    </a>
                                <li class="nav-item active mr-3">
                                    <a class="nav-link" href="{{ route("book.ranking") }}">
                                        <i class="fas fa-crown fa-fw"></i>
                                        <span>ランキング</span>
                                    </a>
                                <li class="nav-item active mr-3">
                                    <a class="nav-link" href="{{-- route("user.callender") --}}">
                                        <i class="far fa-calendar-alt fa-fw"></i>
                                        <span>発売カレンダー</span>
                                    </a>
                                </li>
                                <li class="nav-item active dropdown dropleft">
                                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdownMenuLink" role="button">
                                        <i class="fas fa-user fa-fw"></i>
                                    </a>
                                    <div aria-labelledby="navbarDropdownMenuLink m-5" class="dropdown-menu shadow">
                                        <a class="dropdown-item text-secondary" href="{{-- route("user.detail") --}}">
                                            <i class="fas fa-user fa-fw"></i>
                                            <span>マイページ</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{-- route("user.edit") --}}">
                                            <i class="fas fa-cog fa-fw"></i>
                                            <span>プロフィール編集</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route("about") }}">
                                            <i class="fas fa-book-reader fa-fw"></i>
                                            <span>About</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <span><i class="fas fa-sign-out-alt fa-fw"></i></span>
                                            {{ __('ログアウト') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item active mr-4">
                                    <a href="{{ route("books.list", ["keyword"=> "本", "page" => 1]) }}" class="header_find_book p-3">
                                        本を探す
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("about") }}">
                                        <i class="fas fa-book-reader fa-fw" aria-hidden="true"></i>
                                        <span> About</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("book.ranking") }}">
                                        <i class="fas fa-crown fa-fw" aria-hidden="true"></i>
                                        <span> ランキング</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("login") }}">
                                        <i class="fas fa-user fa-fw" aria-hidden="true"></i>
                                        <span> ログイン</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("register") }}">
                                        <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i>
                                        <span> 新規登録</span>
                                    </a>
                                </li>
                            @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
</html>
