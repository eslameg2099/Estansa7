<x-layout :title="$categorypost->name" :breadcrumbs="['dashboard.categorypost.show', $categorypost]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('categorypost.attributes.name'):</th>
                        <td>{{ $categorypost->name}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('categorypost.attributes.slug'):</th>
                        <td>{{ $categorypost->slug}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('categorypost.attributes.description'):</th>
                        <td>{!! $categorypost->description !!}</td>
                    </tr>
                    @if($categorypost->getFirstMedia())
                        <tr>
                            <th width="200">@lang('categorypost.attributes.image')</th>
                            <td>
                                <file-preview :media="{{ $categorypost->getMediaResource() }}"></file-preview>
                            </td>
                        </tr>
                    @endif
                 
                    </tbody>
                   
                 

                </table>

             


            @endcomponent
  
        
           
    </div>
</x-layout>
