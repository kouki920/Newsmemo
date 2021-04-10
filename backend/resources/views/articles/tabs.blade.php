<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasNewsApi ? 'active' : '' }}" href="{{ route('api.default_index') }}">
            ニュース
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasCovidNews ? 'active' : '' }}" href="{{ route('api.covid_default_index') }}">
            COVID-19
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasArticles ? 'active' : '' }}" href="{{route('articles.index')}}">
            メモリスト
        </a>
    </li>
</ul>