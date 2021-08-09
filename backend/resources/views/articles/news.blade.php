<div class="card mt-2 mb-4">
    @if(isset($data['thumbnail']))
    <img src="{{$data['thumbnail']}}" class="card-img-top img-fluid img-thumbnail news-thumbnail" alt="NEWSAPIのサムネイル" />
    @else
    <img src="{{asset('/assets/images/noimage.png')}}" class="card-img-top img-fluid img-thumbnail news-thumbnail" alt="Noimage" />
    @endif
    <div class="card-body">
        <h5 class="card-title news-title font-md"><a class="news-url" href="{{$data['url']}}" target=”_blank” rel="noopener noreferrer">{{$data['name']}}
            </a></h5>
        <form action="{{route('articles.create')}}" method="POST">
            @csrf
            <input type="hidden" name="news" value="{{$data['name']}}">
            <input type="hidden" name="url" value="{{$data['url']}}">
            <input type="submit" value="メモ">
        </form>
        <form action="{{route('articles.store')}}" method="POST">
            @csrf
            <input type="hidden" name="news" value="{{$data['name']}}">
            <input type="hidden" name="url" value="{{$data['url']}}">
            <input type="hidden" name="body" value="後で読む">
            <input type="submit" value="クイックメモ">
        </form>
    </div>
</div>