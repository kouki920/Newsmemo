<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link bg-secondary text-white {{ $hasArticles ? 'active' : '' }}" href="{{ route('users.show', ['name' => $user->name]) }}">
            メモ
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-secondary text-white {{ $hasLikes ? 'active' : '' }}" href="{{route('users.likes',['name' => $user->name])}}">
            後で読む
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-secondary text-white {{ $hasData ? 'active' : '' }}" href="{{route('users.userData',['name' => $user->name])}}">
            ユーザーデータ
        </a>
    </li>
</ul>