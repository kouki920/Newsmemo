<form class="form-inline ml-3 mt-lg-3">
    @csrf
    <input class="form-control mr-sm-2" type="search" name="search" value="{{request('search')}}" placeholder="検索" aria-label="Search">

    <button class="btn btn-outline-success ml-2 my-sm-0" type="submit">検索</button>

</form>