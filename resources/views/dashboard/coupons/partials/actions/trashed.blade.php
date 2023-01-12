@can('viewAnyTrash', \App\Models\Coupon::class)
    <a href="{{ route('dashboard.coupons.trashed') }}" class="btn btn-outline-danger btn-sm">
        <i class="fas fa fa-fw fa-trash"></i>
        @lang('coupons.trashed')
    </a>
@endcan
