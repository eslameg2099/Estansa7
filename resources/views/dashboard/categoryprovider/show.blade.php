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

           
           
    </div>
</x-layout>
