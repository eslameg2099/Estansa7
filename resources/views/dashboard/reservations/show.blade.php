<x-layout :title="$reservation->id" :breadcrumbs="['dashboard.reservations.show', $reservation]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')
           
          
                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('reservations.attributes.id'):</th>
                        <td>{{ $reservation->id}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.customer'):</th>
                        <td>   <a href="{{ route('dashboard.customers.show', $reservation->customer) }}"
                       class="text-decoration-none text-ellipsis">
                          
                            {{ $reservation->customer->name}}
                    </a></td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.provider'):</th>
                        <td>{{ $reservation->provider->name}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.category_id'):</th>
                        <td>{{ $reservation->category->name}}</td>
                        
                    </tr>
                 
                    <tr>
                        <th width="200">@lang('reservations.attributes.day_at'):</th>
                        <td>{{ $reservation->day_at}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.cost'):</th>
                        <td>{{ $reservation->cost}} EGP</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.discount'):</th>
                        <td>{{ $reservation->discount}} EGP</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.pay'):</th>
                        <td>{{ $reservation->cost - $reservation->discount}} EGP</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.from'):</th>
                        <td>{{ $reservation->from}} </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.to'):</th>
                        <td>{{ $reservation->to}} </td>
                    </tr>
                  

                    <tr>
                        <th width="200">@lang('reservations.attributes.created_at'):</th>
                        <td>{{ $reservation->created_at}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.stauts'):</th>
                    <td>
             @if($reservation->stauts == '1')
             <span class="badge badge-warning">غير مدفوع</span>

                   

                    @elseif($reservation->stauts == '2')
                    <span class="badge badge-success"> مدفوع وجاهز</span>


                    @else
                    <span class="badge badge-dark">منتهي</span>

                    @endif

              </td>
              </tr>
                    <tr>
                        <th width="200">@lang('reservations.attributes.comment'):</th>
                        <td>{!! $reservation->comment !!}</td>
                    </tr>
                 
                    </tbody>
                   
                 

                </table>

             


            @endcomponent
  
        
           
    </div>
</x-layout>
