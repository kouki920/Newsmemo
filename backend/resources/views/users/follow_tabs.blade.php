<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasFollows ? 'active' : '' }}" href="{{ route('users.following', ['name' => $user->name]) }}">
            フォロー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasFollowers ? 'active' : '' }}" href="{{route('users.follower',['name' => $user->name])}}">
            フォロワー
        </a>
    </li>
</ul>