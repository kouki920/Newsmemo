<div class="card collection-name-body">
    <div class="card-body collection-name-content">
        <h2 class="card-title collection-name font-md">-{{ $collection->name }}-</h2>
        <div class="card-text collection-name-count font-md">
            &ensp;{{ $collection->articles->count() }}件
        </div>
    </div>
</div>