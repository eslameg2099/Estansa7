<x-layout :title="$coupon->name" :breadcrumbs="['dashboard.coupons.edit', $coupon]">
    {{ BsForm::resource('coupons')->putModel($coupon, route('dashboard.coupons.update', $coupon)) }}
    @component('dashboard::components.box')
        @slot('title', trans('coupons.actions.edit'))

        @include('dashboard.coupons.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('coupons.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>