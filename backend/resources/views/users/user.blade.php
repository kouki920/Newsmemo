<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex">
            <div class="p-2">
                <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                    @if(!isset($user->image))
                    <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                    @else
                    <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="55" height="55" alt="ユーザーアイコン">
                    @endif



                </a>
            </div>
            <div class=" p-2 align-items-center">
                {{ $user->name }}
            </div>

            <div class="card-text ml-auto p-2">
                @if( Auth::id() !== $user->id )
                <follow-button :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' user-follow="{{ route('users.follow', ['name' => $user->name]) }}" user-follower="{{route('users.follower',['name' => $user->name])}}" user-following="{{route('users.following',['name' => $user->name])}}">
                </follow-button>
                @endif
            </div>
        </div>
    </div>
</div>