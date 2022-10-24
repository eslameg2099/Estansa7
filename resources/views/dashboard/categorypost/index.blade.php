<x-layout :title="trans('categorypost.plural')" :breadcrumbs="['dashboard.categorypost.index']">
    @include('dashboard.categorypost.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('categorypost.actions.list') ({{ $CategoryPosts->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
               

                <div class="ml-2 d-flex justify-content-between flex-grow-1">
                    @include('dashboard.categorypost.partials.actions.create')

                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
            #
            </th>
            <th>اسم القسم</th>
            <th>الحالة</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($CategoryPosts as $categorypost)
            <tr>
                <td> {{ $categorypost->id }} </td>
               
                <td>
                    <a href="{{ route('dashboard.categorypost.show', $categorypost) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $categorypost->name }}
                    </a>
                </td>
                <td>
             @if($categorypost->stauts == '1')
             <span class="badge badge-success">مفعل</span>

                   

                    @else

                    <span class="badge badge-danger">غير مفعل</span>

                    @endif

              </td>
       <td>
      </td>
                <td style="width: 160px">
                @include('dashboard.categorypost.partials.actions.show')
                    @include('dashboard.categorypost.partials.actions.edit')
                    @include('dashboard.categorypost.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('categoryprovider.empty')</td>
            </tr>
        @endforelse

        @if($CategoryPosts->hasPages())
            @slot('footer')
                {{ $CategoryPosts->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
