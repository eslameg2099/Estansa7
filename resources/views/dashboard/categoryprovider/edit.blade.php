<x-layout :title="$categoryprovider->name" :breadcrumbs="['dashboard.categoryprovider.edit', $categoryprovider]">
    {{ BsForm::resource('categoryprovider')->putModel($categoryprovider, route('dashboard.categoryprovider.update', $categoryprovider->id)) }}
    @component('dashboard::components.box')
        @slot('title', trans('categoryprovider.actions.edit'))
        @include('dashboard.categoryprovider.partials.form')
        @slot('footer')
            {{ BsForm::submit()->label(trans('categoryprovider.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>