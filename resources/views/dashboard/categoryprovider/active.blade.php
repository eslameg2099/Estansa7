@if(method_exists($city, 'trashed') && $city->trashed())
    @can('view', $officeOwner)
        <a href="{{ route('dashboard.cities.active', $city) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-up"></i>
        </a>
    @endcan
@else
    @can('view', $city)
        <a href="{{ route('dashboard.cities.active', $city) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-up"></i>
        </a>
    @endcan
@endif