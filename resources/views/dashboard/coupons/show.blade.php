<x-layout :title="$coupon->name" :breadcrumbs="['dashboard.coupons.show', $coupon]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('coupons.attributes.code')</th>
                        <td>{{ $coupon->code }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('coupons.attributes.percentage_value')</th>
                        <td>{{ $coupon->percentage_value }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('coupons.attributes.usage_count')</th>
                        <td>{{ $coupon->used}} /  {{ $coupon->usage_count }}</td>
                    </tr>
                    @if($coupon->expired_at)
                        <tr>
                            <th width="200">@lang('coupons.attributes.expired_at')</th>
                            <td>{{ $coupon->expired_at->toDateTimeString() }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.coupons.partials.actions.edit')
                    @include('dashboard.coupons.partials.actions.delete')
                    @include('dashboard.coupons.partials.actions.restore')
                    @include('dashboard.coupons.partials.actions.forceDelete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
