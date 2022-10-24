@if($city)
    @if(method_exists($city, 'trashed') && $city->trashed())
        <a href="{{ route('dashboard.cities.trashed.show', $city) }}" class="text-decoration-none text-ellipsis">
            {{ $city->name }}
        </a>
    @else
        <a href="{{ route('dashboard.cities.show', $city) }}" class="text-decoration-none text-ellipsis">
            {{ $city->name }}
        </a>
    @endif
@else
    ---
@endif