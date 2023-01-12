<x-layout :title="trans('coupons.plural')" :breadcrumbs="['dashboard.coupons.index']">
    @include('dashboard.coupons.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('coupons.actions.list') ({{ $coupons->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
                <x-check-all-delete
                        type="{{ \App\Models\Coupon::class }}"
                        :resource="trans('coupons.plural')"></x-check-all-delete>

                <div class="ml-2 d-flex justify-content-between flex-grow-1">
                    @include('dashboard.coupons.partials.actions.create')
                    @include('dashboard.coupons.partials.actions.trashed')
                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
              <x-check-all></x-check-all>
            </th>
            <th>@lang('coupons.attributes.code')</th>
            <th>@lang('coupons.attributes.percentage_value')</th>
            <th>@lang('coupons.attributes.created_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($coupons as $coupon)
            <tr>
                <td class="text-center">
                  <x-check-all-item :model="$coupon"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.coupons.show', $coupon) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $coupon->code }}
                    </a>
                </td>
                <td>{{ $coupon->percentage_value }}</td>
                <td>{{ $coupon->created_at->toDateTimeString() }}</td>

                <td style="width: 160px">
                    @include('dashboard.coupons.partials.actions.show')
                    @include('dashboard.coupons.partials.actions.edit')
                    @include('dashboard.coupons.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('coupons.empty')</td>
            </tr>
        @endforelse

        @if($coupons->hasPages())
            @slot('footer')
                {{ $coupons->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
