@if(method_exists($provider, 'trashed') && $provider->trashed())
        <a href="{{ route('dashboard.providers.active', $provider) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-up"></i>
        </a>
    
@else
        <a href="{{ route('dashboard.providers.active', $provider) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-up"></i>
        </a>
@endif