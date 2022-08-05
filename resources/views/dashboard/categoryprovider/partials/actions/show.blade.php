@if(method_exists($categoryprovider, 'trashed') && $categoryprovider->trashed())
        <a href="{{ route('dashboard.categoryprovider.trashed.show', $categoryprovider->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@else
        <a href="{{ route('dashboard.categoryprovider.show', $categoryprovider->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif