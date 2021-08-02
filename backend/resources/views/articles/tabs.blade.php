<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-text d-flex flex-column align-items-center nav-link {{ $hasNewsApi ? 'active' : '' }}" href="{{ route('news.default_index') }}"><i class="nav-icon fas fa-newspaper"></i>
            ニュース
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-text d-flex flex-column align-items-center nav-link {{ $hasCovidNews ? 'active' : '' }}" href="{{ route('news.covid_default_index') }}"><i class="nav-icon fas fa-viruses"></i>
            COVID-19
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-text d-flex flex-column align-items-center nav-link {{ $hasArticles ? 'active' : '' }}" href="{{route('articles.index')}}"><i class="nav-icon fas fa-list"></i>
            メモリスト
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-text d-flex flex-column align-items-center nav-link {{ $hasMypage ? 'active' : '' }}" href="{{route('users.show', ['name' => Auth::user()->name])}}"><i class="nav-icon fas fa-id-card"></i>
            プロフィール
        </a>
    </li>
</ul>