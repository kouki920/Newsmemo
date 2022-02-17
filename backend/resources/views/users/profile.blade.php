    <div class="card user-profile-body">
        <div class="card-body">
            <!-- ユーザーアイコン -->
            <div class="profile-function-body">
                <div class="profile-function-body__user-icon">
                    @if(Auth::id() == config('user.guest_user_id'))
                    @if(!isset($user->image))
                    <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="50" height="50" alt="Noicon">
                    @else
                    <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="50" height="50" alt="ユーザーアイコン">
                    @endif
                    @elseif(Auth::id() == $user->id)
                    <a href="{{ route('users.image_edit', ['name' => $user->name]) }}" class="text-dark">
                        @if(!isset($user->image))
                        <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="50" height="50" alt="Noicon">
                        @else
                        <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="50" height="50" alt="ユーザーアイコン">
                        @endif
                    </a>
                    @elseif(Auth::id() !== $user->id)
                    @if(!isset($user->image))
                    <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="50" height="50" alt="Noicon">
                    @else
                    <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" alt="ユーザーアイコン">
                    @endif
                    @endif
                </div>


                <!-- タグ表示 -->
                <div class="card-text">
                    <div class="dropdown">
                        <a data-toggle="dropdown">
                            <button class="btn dropdown-toggle font-sm profile-function-body__tag-button" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                最近使用したタグ
                            </button>
                        </a>
                        <div class="dropdown-menu profile-function-body__tag-dropdown-menu">
                            <div>
                                @foreach($recentTags as $tag)
                                <ul class="list-group">
                                    <li class="list-group-item profile-function-body__tag-list font-sm">{{$tag}}</li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 編集ボタン -->
                @if(Auth::id() == $user->id)
                <div class="card-text">
                    <a href="{{route('users.edit',['name' => $user->name])}}"><input type="button" class="font-sm btn profile-function-body__edit-button" value="編集"></a>
                </div>
                @endif
            </div>

            <!-- ユーザー名・自己紹介 -->
            <div class="card-body profile-content-body">
                <div class="card-text font-sm profile-content-body__name">
                    {{ $user->name }}
                </div>
                <div class="card-text font-sm profile-content-body__introduction">
                    {{$user->introduction}}
                </div>

                <!-- フォローボタン フォロー・フォロワー数値-->
                <div class="card-text font-sm profile-follow-function-body">
                    @if(Auth::id() !== $user->id)
                    <follow-button-and-count :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' :initial-count-followings='@json($user->count_followings)' :initial-count-followers='@json($user->count_followers)' user-follow="{{ route('users.follow', ['name' => $user->name]) }}" user-follower="{{route('users.follower',['name' => $user->name])}}" user-following="{{route('users.following',['name' => $user->name])}}">
                    </follow-button-and-count>
                    @elseif(Auth::id() == $user->id)
                    <follow-count :authorized='@json(Auth::check())' :initial-count-followings='@json($user->count_followings)' :initial-count-followers='@json($user->count_followers)' user-follow="{{ route('users.follow', ['name' => $user->name]) }}" user-follower="{{route('users.follower',['name' => $user->name])}}" user-following="{{route('users.following',['name' => $user->name])}}">
                    </follow-count>
                    @endif
                </div>
            </div>
        </div>
    </div>