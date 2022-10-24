<x-layout :title="$categorypost->name" :breadcrumbs="['dashboard.categorypost.edit', $categorypost]">
    {{ BsForm::resource('categorypost')->putModel($categorypost, route('dashboard.categorypost.update', $categorypost->id)) }}
    @component('dashboard::components.box')
        @slot('title', trans('categorypost.actions.edit'))
        @include('dashboard.categorypost.partials.form')
        @slot('footer')
            {{ BsForm::submit()->label(trans('categorypost.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>