<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='csrf-token' content='{{ csrf_token() }}'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <title>BookMarks</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://kit.fontawesome.com/7b10f1e4cc.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
                            <!-- <form class="form-inline my-2 my-lg-0" action="/books" accept-charset="UTF-8" method="get">
                                <input required="required" class="form-control mr-sm-2" type="text" name="keyword" id="keyword">
                                <input type="submit" name="commit" value="??????" class="btn btn-sm btn-secondary m-0 ml-sm-0" data-disable-with="??????">
                            </form> -->

                            {{ Form::open(["route" => "book.index", "class" => "form-inline my-2 my-lg-0"]) }}
                                {{ Form::text("keyword", null, ["class" => "form-control mr-sm-2", "placeholder" => "??????", "required" => "true"]) }}
                                {{ Form::hidden('page', 1) }}
                                {{ Form::submit("??????", ["class" => "btn btn-sm btn-secondary m-0 ml-sm-0"])}}
                                @method("GET")
                            {{ Form::close() }}

                            <ul class="navbar-nav ml-auto">
                            @if(\Auth::user())
                                <li class="nav-item active mr-3 mt-2">
                                    <a class="header_find_book p-3" href="{{ route("book.index", ["keyword"=> "???", "page" => 1]) }}">????????????</a>
                                </li>
                                <!-- <li class="nav-item active mr-4">
                                    <a class="nav-link" href="{{ route("user.show", ["user"=>\Auth::user()]) }}">
                                        <i class="fas fa-user fa-fw"></i>
                                        <span>???????????????</span>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item active mr-3">
                                    <a class="nav-link" href="{{-- route("timeline.list") --}}">
                                        <i class="fa fa-tasks"></i>
                                        <span>??????????????????</span>
                                    </a>
                                <li class="nav-item active mr-3">
                                    <a class="nav-link" href="{{ route("book.ranking") }}">
                                        <i class="fas fa-crown fa-fw"></i>
                                        <span>???????????????</span>
                                    </a>
                                <li class="nav-item active mr-3">
                                    <a class="nav-link" href="{{-- route("user.callender") --}}">
                                        <i class="far fa-calendar-alt fa-fw"></i>
                                        <span>?????????????????????</span>
                                    </a>
                                </li> -->
                                <li class="nav-item active dropdown dropleft">
                                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdownMenuLink" role="button">
                                        <i class="fas fa-user fa-fw"></i>
                                    </a>
                                    <div aria-labelledby="navbarDropdownMenuLink m-5" class="dropdown-menu shadow">
                                        <a class="dropdown-item text-secondary" href="{{ route("user.reads", ["user" => \Auth::user()->id, "sort" => "default"]) }}">
                                            <i class="fas fa-user fa-fw"></i>
                                            <span>???????????????</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route("user.edit", ["user" => \Auth::user()->id]) }}">
                                            <i class="fas fa-cog fa-fw"></i>
                                            <span>????????????????????????</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route("book.ranking", ["keyword"=> "???", "page" => 1, "genre" => "??????", "sort" => "sort"]) }}">
                                            <i class="fas fa-crown fa-fw"></i>
                                            <span>???????????????</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route("about") }}">
                                            <i class="fas fa-book-reader fa-fw"></i>
                                            <span>About</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route("contact.form") }}">
                                        <i class="far fa-envelope"></i>
                                            <span>??????????????????</span>
                                        </a>
                                        <a class="dropdown-item text-secondary" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <span><i class="fas fa-sign-out-alt fa-fw"></i></span>
                                            {{ __('???????????????') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item active mr-4">
                                    <a href="{{ route("book.index", ["keyword"=> "???", "page" => 1]) }}" class="header_find_book p-3">
                                        ????????????
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("about") }}">
                                        <i class="fas fa-book-reader fa-fw" aria-hidden="true"></i>
                                        <span> About</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("book.ranking", ["keyword"=> "???", "page" => 1, "genre" => "??????", "sort" => "sort"]) }}">
                                        <i class="fas fa-crown fa-fw" aria-hidden="true"></i>
                                        <span> ???????????????</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("login") }}">
                                        <i class="fas fa-user fa-fw" aria-hidden="true"></i>
                                        <span> ????????????</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("register") }}">
                                        <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i>
                                        <span> ????????????</span>
                                    </a>
                                </li>
                                <li class="nav-item active mr-4">
                                    <a class="text-secondary" href="{{ route("contact.form") }}">
                                        <i class="far fa-envelope"></i>
                                        <span> ??????????????????</span>
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
