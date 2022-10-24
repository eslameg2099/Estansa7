<x-layout :title="$categoryprovider->name" :breadcrumbs="['dashboard.categoryprovider.show', $categoryprovider]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('categoryprovider.attributes.name'):</th>
                        <td>{{ $categoryprovider->name}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('categoryprovider.attributes.slug'):</th>
                        <td>{{ $categoryprovider->slug}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('categoryprovider.attributes.description'):</th>
                        <td>{!! $categoryprovider->description !!}</td>
                    </tr>
                    @if($categoryprovider->getFirstMedia())
                        <tr>
                            <th width="200">@lang('categoryprovider.attributes.image')</th>
                            <td>
                                <file-preview :media="{{ $categoryprovider->getMediaResource() }}"></file-preview>
                            </td>
                        </tr>
                    @endif
                 
                    </tbody>
                   
                 

                </table>

             


            @endcomponent
  
            @if($count < 2)
            {{ BsForm::resource('categoryprovider')->post(route('dashboard.categoryprovider.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('categoryprovider.actions.create'))
       
        @include('dashboard.categoryprovider.partials.form')

       <input type="hidden"  name="parent_id" value="{{$categoryprovider->id}}">
        @slot('footer')
            {{ BsForm::submit()->label(trans('categoryprovider.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
        </div>
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                <thead>
        <tr>
          <th colspan="100">
            <div class="d-flex">
              الاقسام الفرعية
            </div>
          </th>
        </tr>
        <tr>
           
            <th>@lang('categoryprovider.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
                    <tbody>
                    @forelse($categories as $categoryprovider)
            <tr>
              
                <td>
                  
                        {{ $categoryprovider->name }}
                   
                </td>

                <td style="width: 160px">
              
                @include('dashboard.categoryprovider.partials.actions.show')
                @include('dashboard.categoryprovider.partials.actions.delete')


                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('categoryprovider.empty')</td>
            </tr>
        @endforelse
                    </tbody>
                </table>

            @endcomponent
            @endif

        </div>
           
           
    </div>
</x-layout>
