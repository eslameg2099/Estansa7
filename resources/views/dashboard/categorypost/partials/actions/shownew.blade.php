@if(method_exists($sku->id , 'trashed') && $city->trashed())
        <a href="{{ route('dashboard.cities.trashed.show', $sku->id ) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@else
        <a href="{{ route('dashboard.cities.show', $sku->id ) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif