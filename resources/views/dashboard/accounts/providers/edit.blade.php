<x-layout :title="$provider->name" :breadcrumbs="['dashboard.providers.edit', $provider]">
    {{ BsForm::resource('providers')->putModel($provider, route('dashboard.providers.update', $provider), ['files' => true]) }}
    @component('dashboard::components.box')
        @slot('title', trans('customers.actions.edit'))

        @include('dashboard.accounts.providers.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('customers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>
