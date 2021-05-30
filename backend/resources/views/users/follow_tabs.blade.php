<div class="card align-items-center bg-light">
    <div class="card-body d-flex flex-row">
        <div class="card-text text-right">
            {{ $user->name }}
        </div>
    </div>
</div>
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