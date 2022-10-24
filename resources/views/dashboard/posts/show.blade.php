<x-layout :title="$post->name" :breadcrumbs="['dashboard.posts.show', $post]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('posts.attributes.titele'):</th>
                        <td>{{ $post->titele}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('posts.attributes.user_id'):</th>
                        <td>{{ $post->user->name}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('posts.attributes.category_id'):</th>
                        <td>{{ $post->category->name}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('posts.attributes.slug'):</th>
                        <td>{{ $post->slug}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('posts.attributes.view'):</th>
                        <td>{{ $post->view}}</td>
                        
                    </tr>
                    <tr>
                        <th width="200">@lang('posts.attributes.description'):</th>
                        <td>{!! $post->description !!}</td>
                    </tr>
                    @if($post->getFirstMedia())
                        <tr>
                            <th width="200">@lang('posts.attributes.image')</th>
                            <td>
                                <file-preview :media="{{ $post->getMediaResource() }}"></file-preview>
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <th width="200">@lang('posts.attributes.created_at'):</th>
                        <td>{{ $post->created_at}}</td>
                        
                    </tr>
                 
                    </tbody>
                   
                 

                </table>

             


            @endcomponent
  
        
           
    </div>
</x-layout>
