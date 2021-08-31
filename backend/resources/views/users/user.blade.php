<div class="card follow-follower-body">
    <div class="card-body follow-follower-content">
        <div class="follow-follower-user-icon">
            <a href="{{ route('users.show', ['name' => $user->name]) }}">
                @if(!isset($user->image))
                <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                @else
                <img class="profile-icon image-upload rounded-circle img-responsive" src="/storage/{{$user->image}}" alt="ユーザーアイコン">
                @endif
            </a>
        </div>
        <div class="follow-follower-user-name">
            {{ $user->name }}
        </div>

        <div class="card-text follow-follower-button">
            @if( Auth::id() !== $user->id )
            <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' user-follow="{{ route('users.follow', ['name' => $user->name]) }}" user-follower="{{route('users.follower',['name' => $user->name])}}" user-following="{{route('users.following',['name' => $user->name])}}">
            </follow-button>
            @endif
        </div>
    </div>
</div>