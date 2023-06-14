<x-layout :title="trans('dashboard.home')" :breadcrumbs="['dashboard.home']">
<div class="row">
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Reservation::whereDate('day_at', today())->where('stauts','2')->count() }}</h3>

                    <p>{{ __('الاستشارات اليومية') }}</p>
                </div>
                <a href="" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fas fa-th"></i>
                        </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Customer::count() }}</h3>
                    <p>{{ __('عد المستخدمين') }}</p>
                </div>
                <a href="" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Provider::count() }}</h3>

                    <p>{{ __(' عدد مقدمي الخدمات') }}</p>
                </div>
                <a href="" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="icon">
                            <i class="fas fa-address-card"></i>

                        </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\Post::count() }}</h3>

                    <p>{{ __('عدد المقالات') }}</p>
                </div>
                <a href="" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                
                <div class="icon">
                            <i class="fas fa-book-reader"></i>

                         </div>
            </div>
        </div>
        <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ \App\Models\Admin::findorfail(1)->wallet }} EGP</h3>

                    <p>{{ __('رصيد النظام') }}</p>
                </div>
                <a href="" class="small-box-footer">
                    @lang('عرض المزيد')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                
                <div class="icon">
                            <i class="fas fa-book-reader"></i>

                         </div>
            </div>
        </div>
        <!-- ./col -->

        
        <div class="col-lg-12 col-6">

    @include('dashboard.reservations.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('reservations.actions.list') ({{ $Reservations->where('stauts','2')->count() }})
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
                    <span class="badge badge-danger"> مقدم الخدمة معتزر</span>

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
    </div>

      

</div>


   
</x-layout>


