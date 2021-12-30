<div class="card collection-name-body">
    <div class="card-body collection-name-body__content">
        <div class="card-title collection-name-body__content-name font-md">-{{ $collection->name }}-</div>
        <div class="card-title collection-name-body__content-count font-md">
            &ensp;{{ $collection->articles->count() }}件
        </div>
    </div>
</div>