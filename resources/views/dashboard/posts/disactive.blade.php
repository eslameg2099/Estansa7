@if(method_exists($city, 'trashed') && $city->trashed())
    @can('view', $city)
        <a href="{{ route('dashboard.cities.disactive', $city) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-down"></i>
        </a>
    @endcan
@else
    @can('view', $city)
        <a href="{{ route('dashboard.cities.disactive', $city) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-down"></i>
        </a>
    @endcan
@endif