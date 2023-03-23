<x-layout :title="$provider->name" :breadcrumbs="['dashboard.providers.edit', $provider]">
{{ BsForm::resource('providers')->post(route('dashboard.providers.disactive')) }}
    @component('dashboard::components.box')
        @slot('title', trans('customers.actions.textmail'))

        <input type="hidden" id="custId" name="id" value="{{$provider->id}}">

        {{ BsForm::textarea('textmail')->attribute('class', 'form-control')->label(trans('provider.attributes.textmail')) }}

        @slot('footer')
            {{ BsForm::submit()->label(trans('customers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>