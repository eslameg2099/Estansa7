<x-layout :title="trans('categoryprovider.trashed')" :breadcrumbs="['dashboard.categoryprovider.trashed']">
    @include('dashboard.categoryprovider.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('categoryprovider.actions.list') ({{ $CategoryProvideres->total() }})
        @endslot

        <thead>
       
        <tr>
            <th>@lang('categoryprovider.attributes.name')</th>
            <th>الحالة</th>

            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($CategoryProvideres as $categoryprovider)
            <tr>
                
                <td>
                    <a href="{{ route('dashboard.categoryprovider.trashed.show', $CategoryProvideres) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $categoryprovider->name }}
                    </a>
                </td>
                <td>
             @if($categoryprovider->stauts == '1')
             <span class="badge badge-success">مفعل</span>

                   

                    @else

                    <span class="badge badge-danger">غير مفعل</span>

                    @endif

              </td>

                <td style="width: 160px">
                    @include('dashboard.categoryprovider.partials.actions.show')
                    @include('dashboard.categoryprovider.partials.actions.restore')
                    @include('dashboard.categoryprovider.partials.actions.forceDelete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('categoryprovider.empty')</td>
            </tr>
        @endforelse

        @if($CategoryProvideres->hasPages())
            @slot('footer')
                {{ $CategoryProvideres->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
