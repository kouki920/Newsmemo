<div class="card news-body">
    <div class="news-content">
        <div class="card-title news-title font-md"><a class="news-url" href="{{$data['url']}}" target=”_blank” rel="noopener noreferrer">{{$data['name']}}
            </a></div>
        @if(isset($data['thumbnail']))
        <img src="{{$data['thumbnail']}}" class="card-img-top img-fluid img-thumbnail news-thumbnail" alt="NEWSAPIのサムネイル" />
        @else
        <img src="{{asset('/assets/images/noimage.png')}}" class="card-img-top img-fluid img-thumbnail news-thumbnail" alt="Noimage" />
        @endif
    </div>

    <div class="card-body news-button">
        <div class="news-memo-button">
            <form action="{{route('articles.create')}}" method="POST">
                @csrf
                <input type="hidden" name="news" value="{{$data['name']}}">
                <input type="hidden" name="url" value="{{$data['url']}}">
                <input class="font-sm news-memo-button-layout" type="submit" value="メモ">
            </form>
        </div>
        <div class="news-quick-memo-button">
            <form action="{{route('articles.store')}}" method="POST">
                @csrf
                <input type="hidden" name="news" value="{{$data['name']}}">
                <input type="hidden" name="url" value="{{$data['url']}}">
                <input type="hidden" name="body" value="後で読む">
                <input class="font-sm news-quick-memo-button-layout" type="submit" value="クイックメモ">
            </form>
        </div>
    </div>
</div>