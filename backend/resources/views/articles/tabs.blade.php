<ul class="nav nav-tabs nav-justified py-1 bg-white">
    <li class="nav-item header-title" id="header-title">
        <a class="d-flex flex-column align-items-center nav-link bg-white text-muted {{ $hasNewsApi ? 'active' : '' }}" href="{{ route('news.default_index') }}"><i class="fas fa-newspaper"></i>
            ニュース
        </a>
    </li>
    <li class="nav-item header-title" id="header-title">
        <a class="d-flex flex-column align-items-center nav-link bg-white text-muted {{ $hasCovidNews ? 'active' : '' }}" href="{{ route('news.covid_default_index') }}"><i class="fas fa-viruses"></i>
            COVID-19
        </a>
    </li>
    <li class="nav-item header-title" id="header-title">
        <a class="d-flex flex-column align-items-center nav-link bg-white text-muted {{ $hasArticles ? 'active' : '' }}" href="{{route('articles.index')}}"><i class="fas fa-list"></i>
            メモリスト
        </a>
    </li>
    <li class="nav-item" id="header-title">
        <a class="d-flex flex-column align-items-center nav-link bg-white text-muted {{ $hasMypage ? 'active' : '' }}" href="{{route('users.show', ['name' => Auth::user()->name])}}"><i class="fas fa-id-card"></i>
            プロフィール
        </a>
    </li>
</ul>