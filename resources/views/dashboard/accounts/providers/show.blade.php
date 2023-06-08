<x-layout :title="$provider->name" :breadcrumbs="['dashboard.providers.show', $provider]">
    @component('dashboard::components.box')
        @slot('bodyClass', 'p-0')

        <table class="table table-striped table-middle">
            <tbody>
            <tr>
                <th width="200">@lang('provider.attributes.name')</th>
                <td>{{ $provider->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.last_name')</th>
                <td>{{ $provider->last_name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.category_parent')</th>
                <td>{{ $provider->categories[0]->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.category_id')</th>
                <td>{{ $provider->category->name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.address')</th>
                <td>{{ $provider->address }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.bio')</th>
                <td>{{ $provider->bio }}</td>
            </tr>
         
            <tr>
                <th width="200">@lang('provider.attributes.email')</th>
                <td>{{ $provider->email }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.phone')</th>
                <td>{{ $provider->phone }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.skills')</th>
                <td>{{ $provider->skills }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.linkedin')</th>
                <td>{{ $provider->linkedin }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.unit_price')</th>
                <td>{{ $provider->unit_price }}</td>
            </tr>
         
            <tr>
                <th width="200">@lang('provider.attributes.experience')</th>
                <td>{{ $provider->experienceyears() }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.bank_name')</th>
                <td>{{ $provider->bank_name }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.iban')</th>
                <td>{{ $provider->iban }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.account_bank')</th>
                <td>{{ $provider->account_bank }}</td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.free_session')</th>
                <td>{{ $provider->free_session() }}</td>
            </tr>
            
            <tr>
                <th width="200">@lang('provider.stauts')</th>
                <td>
                @if($provider->provider_verified_at != null )
             <span class="badge badge-success">مفعل</span>

                   

                    @else

                    <span class="badge badge-danger">غير مفعل</span>

                    @endif
                </td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.avatar')</th>
                <td>
                    @if($provider->getFirstMedia('avatars'))
                        <file-preview :media="{{ $provider->getMediaResource('avatars') }}"></file-preview>
                    @else
                        <img src="{{ $provider->getAvatar() }}"
                             class="img img-size-64"
                             alt="{{ $provider->name }}">
                    @endif
                </td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.certificate')</th>
                <td>
                    @if($provider->getFirstMedia('default'))
                        <file-preview :media="{{ $provider->getMediaResource('default') }}"></file-preview>
                  
                    @endif
                </td>
            </tr>
            <tr>
                <th width="200">@lang('provider.attributes.cv')</th>
                <td> <a href="{{$provider->getFirstMediaUrl("cv")}}">تحميل </a>
</td>
<tr>
                <th width="200">عدد الاستشارات</th>
                <td>{{ $provider->Reservations->count() }}</td>
            </tr>
            </tr>
            </tbody>
        </table>

        @slot('footer')
            @include('dashboard.accounts.providers.partials.actions.edit')
            @include('dashboard.accounts.providers.partials.actions.delete')
           
        @endslot
    @endcomponent
</x-layout>
