@if(method_exists($coupon, 'trashed') && $coupon->trashed())
        <a href="{{ route('dashboard.coupons.trashed.show', $coupon) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@else
        <a href="{{ route('dashboard.coupons.show', $coupon) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif