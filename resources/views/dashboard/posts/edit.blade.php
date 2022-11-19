<x-layout :title="$post->titele" :breadcrumbs="['dashboard.posts.edit', $post]">
    {{ BsForm::resource('posts')->putModel($post, route('dashboard.posts.update', $post->id)) }}
    @component('dashboard::components.box')
        @slot('title', trans('posts.actions.edit'))
        @include('dashboard.posts.partials.form')
        @slot('footer')
            {{ BsForm::submit()->label(trans('posts.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>