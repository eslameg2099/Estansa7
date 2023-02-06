<x-layout :title="trans('reservations.plural')" :breadcrumbs="['dashboard.reservations.index']">
    @include('dashboard.reservations.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('reservations.actions.list') ({{ $Reservations->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
               

                <div class="ml-2 d-flex justify-content-between flex-grow-1">

                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
            #
            </th>
            <th>@lang('reservations.attributes.day_at')</th>
            <th>@lang('reservations.attributes.customer')</th>
            <th>@lang('reservations.attributes.provider')</th>
            <th>@lang('reservations.attributes.category_id')</th>

            <th>الحالة</th>
            <th>تاريخ الانشاء</th>

            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($Reservations as $reservation)
            <tr>
                <td> {{ $reservation->id }} </td>
                <td> {{ $reservation->day_at }} </td>
                <td> {{ $reservation->customer->name }} </td>
                <td> {{ $reservation->provider->name }} </td>
                <td> {{ $reservation->category->name }} </td>

                <td>
             @if($reservation->stauts == '1')
             <span class="badge badge-warning">غير مدفوع</span>

                   

                    @elseif($reservation->stauts == '2')
                    <span class="badge badge-success"> مدفوع وجاهز</span>

                    @elseif($reservation->stauts == '4')
                    <span class="badge badge-danger"> مقدم الخدمة معتز</span>
                    @else
                    <span class="badge badge-dark">منتهي</span>

                    @endif

              </td>
              <td> {{ $reservation->created_at }} </td>

       <td>
      </td>
                <td style="width: 160px">
                @include('dashboard.reservations.partials.actions.show')

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('reservations.empty')</td>
            </tr>
        @endforelse

        @if($Reservations->hasPages())
            @slot('footer')
                {{ $Reservations->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
