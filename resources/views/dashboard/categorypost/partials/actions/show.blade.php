@if(method_exists($categorypost, 'trashed') && $categorypost->trashed())
        <a href="{{ route('dashboard.categorypost.trashed.show', $categorypost->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@else
        <a href="{{ route('dashboard.categorypost.show', $categorypost->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif