<div class="card news-body">
    <div class="news-body__content">
        <div class="card-title news-body__title font-md"><a class="news-body__url" href="{{$data['url']}}" target=”_blank” rel="noopener noreferrer">{{$data['name']}}
            </a></div>
        @if(isset($data['thumbnail']))
        <img src="{{$data['thumbnail']}}" class="card-img-top img-fluid img-thumbnail news-body__thumbnail" alt="NEWSAPIのサムネイル" />
        @else
        <img src="{{asset('/assets/images/noimage.png')}}" class="card-img-top img-fluid img-thumbnail news-thumbnail" alt="Noimage" />
        @endif
    </div>

    <div class="card-body news-body__button">
        <div class="news-body__memo-button">
            <form action="{{route('articles.create')}}" method="POST">
                @csrf
                <input type="hidden" name="news" value="{{$data['name']}}">
                <input type="hidden" name="url" value="{{$data['url']}}">
                <input class="font-sm news-body__memo-button-text" type="submit" value="メモ">
            </form>
        </div>
        <div class="news-quick-memo-button">
            <form action="{{route('articles.store')}}" method="POST">
                @csrf
                <input type="hidden" name="news" value="{{$data['name']}}">
                <input type="hidden" name="url" value="{{$data['url']}}">
                <input type="hidden" name="body" value="後で読む">
                <input class="font-sm news-body__quick-memo-button-text" type="submit" value="クイックメモ">
            </form>
        </div>
    </div>
</div>