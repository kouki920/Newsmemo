<ul class="nav nav-tabs nav-justified py-1 bg-white">
    <li class="nav-item bg-white">
        <a class="nav-link bg-white text-muted {{ $hasNewsApi ? 'active' : '' }}" href="{{ route('news.default_index') }}">
            ニュース
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-white text-muted {{ $hasCovidNews ? 'active' : '' }}" href="{{ route('news.covid_default_index') }}">
            COVID-19
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-white text-muted {{ $hasArticles ? 'active' : '' }}" href="{{route('articles.index')}}">
            メモリスト
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link bg-white text-muted {{ $hasMypage ? 'active' : '' }}" href="{{route('users.show', ['name' => Auth::user()->name])}}">
            プロフィール
        </a>
    </li>
</ul>