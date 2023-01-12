@if($coupon)
    @if(method_exists($coupon, 'trashed') && $coupon->trashed())
        <a href="{{ route('dashboard.coupons.trashed.show', $coupon) }}" class="text-decoration-none text-ellipsis">
            {{ $coupon->name }}
        </a>
    @else
        <a href="{{ route('dashboard.coupons.show', $coupon) }}" class="text-decoration-none text-ellipsis">
            {{ $coupon->name }}
        </a>
    @endif
@else
    ---
@endif