<div class="search-form">
    <form class="form-inline">
        @csrf
        <input class="form-control search-content font-sm" type="search" name="search" value="{{request('search')}}" placeholder="検索" aria-label="Search">

        <button class="btn search-button font-sm" type="submit">検索</button>

    </form>
</div>