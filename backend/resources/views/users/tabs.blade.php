<ul class="nav nav-tabs nav-justified">
    <li class="nav-item user-tabs">
        <a class="user-tabs-text font-sm nav-link {{ $hasArticles ? 'active' : '' }}" href="{{ route('users.show', ['name' => $user->name]) }}">
            投稿
        </a>
    </li>
    <li class="nav-item user-tabs">
        <a class="user-tabs-text font-sm nav-link {{ $hasLikes ? 'active' : '' }}" href="{{route('users.likes',['name' => $user->name])}}">
            ブックマーク
        </a>
    </li>
    <li class="nav-item user-tabs">
        <a class="user-tabs-text font-sm nav-link {{ $hasData ? 'active' : '' }}" href="{{route('users.userData',['name' => $user->name])}}">
            その他
        </a>
    </li>
</ul>