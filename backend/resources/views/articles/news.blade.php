<div class="card mb-2">
    @if(isset($data['thumbnail']))
    <img src="{{$data['thumbnail']}}" class="card-img-top img-fluid img-thumbnail" alt="NEWSAPIのサムネイル" />
    @else
    <img src="{{asset('/assets/images/noimage.png')}}" class="card-img-top img-fluid img-thumbnail" alt="Noimage" />
    @endif
    <div class="card-body">
        <h5 class="card-title"><a href="{{$data['url']}}" target=”_blank” rel="noopener noreferrer">{{$data['name']}}
            </a></h5>
        <form action="{{route('articles.create')}}" method="POST">
            @csrf
            <input type="hidden" name="news" value="{{$data['name']}}">
            <input type="hidden" name="url" value="{{$data['url']}}">
            <input type="submit" value="メモする">
        </form>
    </div>
</div>