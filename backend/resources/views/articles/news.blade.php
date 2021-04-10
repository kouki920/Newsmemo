<div class="card mb-2">
    @if(isset($data['thumbnail']))
    <img src="{{$data['thumbnail']}}" class="card-img-top img-fluid img-thumbnail" alt="NEWSAPIのサムネイル" />
    @else
    <img src="{{asset('/assets/images/noimage.png')}}" class="card-img-top img-fluid img-thumbnail" alt="Noimage" />
    @endif
    <div class="card-body">
        <h5 class="card-title"><a href="{{$data['url']}}" target=”_blank” rel="noopener">{{$data['name']}}</a></h5>
        <a href="{{route('articles.create')}}" class="btn btn-primary">メモする</a>
    </div>
</div>