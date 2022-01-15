<div class="m-3">
    {{$articles->appends(request()->input())->links('vendor.pagination.custom_pagination')}}
</div>