<x-layout :title="trans('coupons.actions.create')" :breadcrumbs="['dashboard.coupons.create']">
    {{ BsForm::resource('coupons')->post(route('dashboard.coupons.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('coupons.actions.create'))

        @include('dashboard.coupons.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('coupons.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>