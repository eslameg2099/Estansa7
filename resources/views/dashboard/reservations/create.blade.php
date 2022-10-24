<x-layout :title="trans('posts.actions.create')" :breadcrumbs="['dashboard.posts.create']">
    {{ BsForm::resource('posts')->post(route('dashboard.posts.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('posts.actions.create'))
        @include('dashboard.posts.partials.form')
        @slot('footer')
            {{ BsForm::submit()->label(trans('categoryprovider.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>