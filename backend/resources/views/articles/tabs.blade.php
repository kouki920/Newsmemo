<ul class="nav nav-tabs nav-justified">
    <li class="nav-item news-tabs">
        <a class="news-tabs__text d-flex flex-column align-items-center nav-link {{ $hasNewsApi ? 'active' : '' }}" href="{{ route('news.default_index') }}"><i class="news-tabs__icon fas fa-newspaper"></i>
            NEWS
        </a>
    </li>
    <li class="nav-item news-tabs">
        <a class="news-tabs__text d-flex flex-column align-items-center nav-link {{ $hasCovidNews ? 'active' : '' }}" href="{{ route('news.covid_default_index') }}"><i class="news-tabs__icon fas fa-viruses"></i>
            COVID-19
        </a>
    </li>
    <li class="nav-item news-tabs">
        <a class="news-tabs__text d-flex flex-column align-items-center nav-link {{ $hasArticles ? 'active' : '' }}" href="{{route('articles.index')}}"><i class="news-tabs__icon fas fa-list"></i>
            POST
        </a>
    </li>
    <li class="nav-item news-tabs">
        <a class="news-tabs__text d-flex flex-column align-items-center nav-link {{ $hasMypage ? 'active' : '' }}" href="{{route('users.show', ['name' => Auth::user()->name])}}"><i class="news-tabs__icon fas fa-id-card"></i>
            PROFILE
        </a>
    </li>
</ul>