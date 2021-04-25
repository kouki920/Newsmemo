    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex flex-row">
                @if(Auth::id() == config('user.guest_user_id'))
                @if(empty($user->image))
                <i class="fas fa-user-circle fa-3x mr-1"></i>
                @else
                <img class="profile-icon image-upload rounded-circle img-responsive" src="/storage/{{$user->image}}" width="60" height="60" alt="ユーザーアイコン">
                @endif
                </a>
                @elseif(Auth::id() == $user->id)
                <a href="{{ route('users.imageEdit', ['name' => $user->name]) }}" class="text-dark">
                    @if(empty($user->image))
                    <i class="fas fa-user-circle fa-3x mr-1"></i>
                    @else
                    <img class="profile-icon image-upload rounded-circle img-responsive" src="/storage/{{$user->image}}" width="60" height="60" alt="ユーザーアイコン">
                    @endif
                </a>
                @endif

                @if(Auth::id() !== $user->id)
                <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
                </follow-button>
                @endif
            </div>
            <div class="card-text">
                <h2 class="h5 card-title mt-1">
                    {{ $user->name }}
                </h2>
            </div>
            <div class="card-text">
                {{$user->introduction}}
            </div>
            @if(Auth::id() == $user->id)
            <div class="card-text mt-2">
                <a href="{{route('users.edit',['name' => $user->name])}}"><input type="button" class="btn btn-info" value="編集"></a>
            </div>
            @endif
        </div>

        <div class="card-body">
            <div class="card-text">
                <a href="{{route('users.following',['name' => $user->name])}}" class="text-muted">
                    {{$user->count_followings}}&ensp;フォロー&ensp;
                </a>
                <a href="{{route('users.follower',['name' => $user->name])}}" class="text-muted">
                    {{$user->count_followers}}&ensp;フォロワー
                </a>
            </div>
        </div>
    </div>