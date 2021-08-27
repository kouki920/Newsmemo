<div class="card align-items-center">
    <div class="card-body d-flex flex-row ">
        <h2 class="card-title font-md m-0">{{ $collection->name }}</h2>
        <div class="card-text font-md text-right">
            {{ $collection->articles->count() }}件
        </div>
    </div>
</div>