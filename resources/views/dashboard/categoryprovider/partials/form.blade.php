@include('dashboard.errors')

{{ BsForm::text('name')->label(trans('categoryprovider.attributes.name')) }}

{{ BsForm::textarea('description')->label(trans('categoryprovider.attributes.description')) }}

{{ BsForm::checkbox('stauts')->value(1)->withDefault()->checked($CategoryProvider->stauts ?? old('stauts')) }}

@isset($categoryprovider)
    {{ BsForm::image('image')->files($categoryprovider->getMediaResource()) }}
@else
    {{ BsForm::image('image') }}
@endisset


      

