@if(method_exists($reservation, 'trashed') && $reservation->trashed())
        <a href="{{ route('dashboard.reservations.trashed.show', $reservation->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@else
        <a href="{{ route('dashboard.reservations.show', $reservation->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif