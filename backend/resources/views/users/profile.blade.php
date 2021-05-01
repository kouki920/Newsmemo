    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row">
                @if(Auth::id() == $user->id)
                <a href="{{ route('users.imageEdit', ['name' => $user->name]) }}" class="text-dark">
                    @if(!isset($user->image))
                    <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                    @else
                    <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="55" height="55" alt="ユーザーアイコン">
                    @endif
                </a>
                @endif

                @if(Auth::id() !== $user->id)
                @if(!isset($user->image))
                <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                @else
                <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="55" height="55" alt="ユーザーアイコン">
                @endif
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
                <div class="card-text">
                    {{$user->introduction}}
                </div>
            </div>
            <div class="row float-left">
                <div class="ml-auto card-text col">
                    <div class="dropdown">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                最近使用したタグ
                            </button>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item bg-info text-center">最近使用したタグ</li>
                                </ul>
                                @foreach($total_category as $category)
                                <ul class="list-group">
                                    <li class="list-group-item h6">{{$category}}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::id() == $user->id)
                <div class="card-text col">
                    <a href="{{route('users.edit',['name' => $user->name])}}"><input type="button" class="btn btn-info" value="編集"></a>
                </div>
                @endif
            </div>
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