<x-layout :title="trans('categoryprovider.plural')" :breadcrumbs="['dashboard.categoryprovider.index']">
    @include('dashboard.categoryprovider.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('categoryprovider.actions.list') ({{ $CategoryProvideres->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
               

                <div class="ml-2 d-flex justify-content-between flex-grow-1">
                    @include('dashboard.categoryprovider.partials.actions.create')
                    @include('dashboard.categoryprovider.partials.actions.trashed')

                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
            #
            </th>
            <th>اسم النوع</th>
            <th>الحالة</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($CategoryProvideres as $categoryprovider)
            <tr>
                <td> {{ $categoryprovider->id }} </td>
               
                <td>
                    <a href="{{ route('dashboard.categoryprovider.show', $categoryprovider) }}"
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
       <td>
      </td>
                <td style="width: 160px">
                @include('dashboard.categoryprovider.partials.actions.show')
                    @include('dashboard.categoryprovider.partials.actions.edit')
                    @include('dashboard.categoryprovider.partials.actions.delete')
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
