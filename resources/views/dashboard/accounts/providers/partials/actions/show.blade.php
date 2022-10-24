@if(method_exists($provider, 'trashed') && $provider->trashed())
        <a href="{{ route('dashboard.providers.trashed.show', $provider) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
    
@else
        <a href="{{ route('dashboard.providers.show', $provider) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif