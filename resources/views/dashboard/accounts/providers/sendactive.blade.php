<x-layout :title="$provider->name" :breadcrumbs="['dashboard.providers.edit', $provider]">
    {{ BsForm::resource('providers')->putModel($provider, route('dashboard.providers.sendactive', $provider->id), ['files' => true]) }}
    @component('dashboard::components.box')
        @slot('title', trans('customers.actions.textmail'))

        {{ BsForm::textarea('textmail')->attribute('class', 'form-control')->label(trans('provider.attributes.textmail')) }}

        @slot('footer')
            {{ BsForm::submit()->label(trans('customers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>