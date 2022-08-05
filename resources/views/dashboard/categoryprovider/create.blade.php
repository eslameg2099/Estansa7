<x-layout :title="trans('categoryprovider.create')" :breadcrumbs="['dashboard.categoryprovider.create']">
    {{ BsForm::resource('categoryprovider')->post(route('dashboard.categoryprovider.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('categoryprovider.actions.create'))
        @include('dashboard.categoryprovider.partials.form')
        @slot('footer')
            {{ BsForm::submit()->label(trans('categoryprovider.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>