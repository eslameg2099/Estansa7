<x-layout :title="trans('posts.plural')" :breadcrumbs="['dashboard.posts.index']">
    @include('dashboard.posts.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title')
            @lang('posts.actions.list') ({{ $Posts->total() }})
        @endslot

        <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
               

                <div class="ml-2 d-flex justify-content-between flex-grow-1">
                    @include('dashboard.posts.partials.actions.create')

                </div>
            </div>
          </th>
        </tr>
        <tr>
            <th style="width: 30px;" class="text-center">
            #
            </th>
            <th>اسم المقال</th>
            <th>اسم الناشر</th>
            <th>اسم القسم</th>

            <th>الحالة</th>
            <th>تاريخ الانشاء</th>

            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($Posts as $post)
            <tr>
                <td> {{ $post->id }} </td>
                <td> {{ $post->titele }} </td>
                <td> {{ $post->user->name }} </td>
                <td> {{ $post->category->name }} </td>

                <td>
             @if($post->stauts == '1')
             <span class="badge badge-success">مفعل</span>

                   

                    @else

                    <span class="badge badge-danger">غير مفعل</span>

                    @endif

              </td>
              <td> {{ $post->created_at }} </td>

       <td>
      </td>
                <td style="width: 160px">
                @include('dashboard.posts.partials.actions.show')
                    @include('dashboard.posts.partials.actions.edit')
                    @include('dashboard.posts.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('posts.empty')</td>
            </tr>
        @endforelse

        @if($Posts->hasPages())
            @slot('footer')
                {{ $Posts->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
