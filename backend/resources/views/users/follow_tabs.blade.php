<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link bg-secondary text-white {{ $hasFollows ? 'active' : '' }}" href="{{ route('users.following', ['name' => $user->name]) }}">
            フォロー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-secondary text-white {{ $hasFollowers ? 'active' : '' }}" href="{{route('users.follower',['name' => $user->name])}}">
            フォロワー
        </a>
    </li>
</ul>