@include('dashboard.errors')
{{ BsForm::text('name')->label(trans('provider.attributes.name')) }}

{{ BsForm::text('email')->label(trans('provider.attributes.email')) }}
{{ BsForm::text('phone')->label(trans('provider.attributes.phone')) }}
{{ BsForm::text('address')->label(trans('provider.attributes.address')) }}
{{ BsForm::password('password')->label(trans('provider.attributes.password')) }}
{{ BsForm::password('password_confirmation')->label(trans('provider.attributes.password_confirmation')) }}
{{ BsForm::number('unit_price')->label(trans('provider.attributes.unit_price')) }}
{{ BsForm::number('experience')->label(trans('provider.attributes.experience')) }}

{{ BsForm::text('linkedin')->label(trans('provider.attributes.linkedin')) }}
{{ BsForm::textarea('bio')->attribute('class', 'form-control textarea')->label(trans('provider.attributes.bio')) }}
{{ BsForm::textarea('skills')->attribute('class', 'form-control textarea')->label(trans('provider.attributes.skills')) }}

<div class="form-group">
    <label>نوع الخدمة المقدمة</label>
    <select name="category_id" class="form-control">
        
        @foreach($CategoryProvideres as $CategoryProvider)
        <option selected="selected" value="">
اختر
</option>
        <option value="{{$CategoryProvider->id}}">{{$CategoryProvider->name}}</option>
        @endforeach
    </select>
</div>


@isset($customer)
    {{ BsForm::image('avatar')->collection('avatars')->files($customer->getMediaResource('avatars')) }}
@else

    {{ BsForm::image('avatar')->collection('avatars')->label(trans('provider.attributes.avatar')) }}
    {{ BsForm::image('cv')->collection('cv')->label(trans('provider.attributes.cv')) }}
    {{ BsForm::image('default')->collection('default')->unlimited()->label(trans('provider.attributes.certificate')) }}


@endisset
