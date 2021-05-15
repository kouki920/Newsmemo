<nav class="navbar navbar-expand navbar-dark blue-gradient">

    <a class="navbar-brand" href="{{route('news.default_index')}}"><i class="far fa-sticky-note mr-1"></i>Newsmemo</a>

    <ul class="navbar-nav ml-auto">

        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">ユーザー登録</a>
        </li>
        @endguest

        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">ログイン</a>
        </li>
        @endguest

        @auth
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(empty(Auth::user()->image))
                <i class="fas fa-user-circle"></i>
                @else
                <img src="/storage/{{Auth::user()->image}}" class="user-mini-icon rounded-circle" width="30" height="30">
                @endif
            </a>
            <div class=" dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
                    マイページ
                </button>
                <div class="dropdown-divider"></div>
                <button form="setting-button" class="dropdown-item" type="submit">
                    設定
                </button>
                <div class="dropdown-divider"></div>
                <button form="logout-button" class="dropdown-item" type="submit">
                    ログアウト
                </button>

            </div>
        </li>
        <form id="logout-button" method="POST" action="{{route('logout')}}">
            @csrf
        </form>
        <form id="setting-button" method="POST" action="{{route('setting.index',['name' => Auth::user()->name])}}">
            @csrf
        </form>
        <!-- Dropdown -->
        @endauth
    </ul>

</nav>