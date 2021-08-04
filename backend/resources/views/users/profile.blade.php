    <div class="card user-profile-body">
        <div class="card-body">
            <!-- ユーザーアイコン -->
            <div class="d-flex flex-row">
                @if(Auth::id() == config('user.guest_user_id'))
                @if(!isset($user->image))
                <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                @else
                <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="55" height="55" alt="ユーザーアイコン">
                @endif
                @elseif(Auth::id() == $user->id)
                <a href="{{ route('users.image_edit', ['name' => $user->name]) }}" class="text-dark">
                    @if(!isset($user->image))
                    <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                    @else
                    <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="55" height="55" alt="ユーザーアイコン">
                    @endif
                </a>
                @elseif(Auth::id() !== $user->id)
                @if(!isset($user->image))
                <img src="{{asset('/assets/images/noicon.jpeg')}}" class="profile-icon image-upload rounded-circle img-responsive mr-1" width="55" height="55" alt="Noicon">
                @else
                <img class="profile-icon image-upload rounded-circle img-responsive mr-1" src="/storage/{{$user->image}}" width="55" height="55" alt="ユーザーアイコン">
                @endif
                @endif

                <!-- タグ表示 -->
                <div class="row">
                    <div class="card-text col">
                        <div class="dropdown">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button class="btn recent-tags-btn dropdown-toggle font-sm" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                    最近使用したタグ
                                </button>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right category-dropdown-menu">
                                <div>
                                    @foreach($total_category as $category)
                                    <ul class="list-group">
                                        <li class="list-group-item h6">{{$category}}</li>
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 編集ボタン -->
                    @if(Auth::id() == $user->id)
                    <div class="card-text col">
                        <a href="{{route('users.edit',['name' => $user->name])}}"><input type="button" class="font-sm btn edit-button" value="編集"></a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- ユーザー名・自己紹介 -->
            <div class="card-text float-left">
                <p class="card-title font-md">
                    {{ $user->name }}
                </p>
                {{$user->introduction}}


                <!-- フォローボタン フォロー・フォロワー数値-->
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