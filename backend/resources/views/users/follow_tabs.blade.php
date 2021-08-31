<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link follow-tab-link font-sm {{ $hasFollows ? 'active' : '' }}" href="{{ route('users.following', ['name' => $user->name]) }}">
            フォロー
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link follower-tab-link font-sm {{ $hasFollowers ? 'active' : '' }}" href="{{route('users.follower',['name' => $user->name])}}">
            フォロワー
        </a>
    </li>
</ul>