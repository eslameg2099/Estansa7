<x-layout :title="trans('provider.plural')" :breadcrumbs="['dashboard.providers.index']">
    @include('dashboard.accounts.providers.partials.filter')

    @component('dashboard::components.table-box')

        @slot('title')
            @lang('provider.actions.list') ({{ count_formatted($providers->total()) }})
        @endslot

        <thead>
        <tr>
            <th colspan="100">
                <div class="d-flex">
                 

                    <div class="ml-2 d-flex justify-content-between flex-grow-1">
                        @include('dashboard.accounts.providers.partials.actions.create')
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th>
                <x-check-all></x-check-all>
            </th>
            <th>@lang('provider.attributes.name')</th>
            <th class="d-none d-md-table-cell">@lang('provider.attributes.email')</th>
            <th>@lang('provider.attributes.phone')</th>
            <th>عدد الاستشارات</th>

            <th>@lang('provider.attributes.created_at')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($providers as $provider)
            <tr>
                <td>
                    <x-check-all-item :model="$provider"></x-check-all-item>
                </td>
                <td>
                    <a href="{{ route('dashboard.providers.show', $provider) }}"
                       class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.accounts.providers.partials.flags.svg')
                            </span>
                     
                        {{ $provider->name }}
                    </a>
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $provider->email }}
                </td>
                <td>
                    @include('dashboard.accounts.providers.partials.flags.phone')
                </td>
                <td>{{ $provider->reservations_count }}</td>

                
                <td>{{ $provider->created_at->format('Y-m-d') }}</td>

                <td style="width: 160px">
                    @include('dashboard.accounts.providers.partials.actions.show')
                    @if($provider->phone_verified_at != null && $provider->provider_verified_at != null)

                    @include('dashboard.accounts.providers.partials.actions.disactive')
                    
                    @elseif($provider->phone_verified_at == null || $provider->provider_verified_at == null )
                    <a href="{{ route('dashboard.providers.sendactive', $provider->id) }}" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-thumbs-up"></i>
                    </a>
                    @endif
                    @include('dashboard.accounts.providers.partials.actions.edit')
                    @include('dashboard.accounts.providers.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('provider.empty')</td>
            </tr>
        @endforelse

        @if($providers->hasPages())
            @slot('footer')
                {{ $providers->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
