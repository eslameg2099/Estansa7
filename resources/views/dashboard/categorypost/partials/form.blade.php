@include('dashboard.errors')

{{ BsForm::text('name')->label(trans('categorypost.attributes.name')) }}
{{ BsForm::text('slug')->label(trans('categorypost.attributes.slug')) }}

{{ BsForm::textarea('description')->label(trans('categorypost.attributes.description')) }}

{{ BsForm::checkbox('stauts')->value(1)->withDefault()->checked($categorypost->stauts ?? old('stauts')) }}

@isset($categorypost)
    {{ BsForm::image('image')->files($categorypost->getMediaResource()) }}
@else
    {{ BsForm::image('image') }}
@endisset


      

