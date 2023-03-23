@if(method_exists($provider, 'trashed') && $provider->trashed())
    
        <a href="{{ route('dashboard.providers.senddeactive', $provider->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-down"></i>
        </a>
@else


        <a href="{{ route('dashboard.providers.senddeactive', $provider->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa-thumbs-down"></i>
        </a>
   
@endif