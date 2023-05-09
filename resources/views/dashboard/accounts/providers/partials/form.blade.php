@include('dashboard.errors')
{{ BsForm::text('name')->label(trans('provider.attributes.name')) }}
{{ BsForm::text('last_name')->label(trans('provider.attributes.last_name'))  }}

{{ BsForm::text('email')->label(trans('provider.attributes.email')) }}
{{ BsForm::text('phone')->label(trans('provider.attributes.phone')) }}
{{ BsForm::text('address')->label(trans('provider.attributes.address')) }}
{{ BsForm::password('password')->label(trans('provider.attributes.password')) }}
{{ BsForm::password('password_confirmation')->label(trans('provider.attributes.password_confirmation')) }}
{{ BsForm::number('unit_price')->label(trans('provider.attributes.unit_price')) }}

{{ BsForm::text('linkedin')->label(trans('provider.attributes.linkedin')) }}
{{ BsForm::textarea('bio')->attribute('class', 'form-control')->label(trans('provider.attributes.bio')) }}
{{ BsForm::textarea('skills')->attribute('class', 'form-control')->label(trans('provider.attributes.skills')) }}

@isset($provider)
<div class="form-group">
    <label>نوع الخدمة المقدمة</label>
    <select name="category_id" class="form-control">
        
        @foreach($CategoryProvideres as $CategoryProvider)
      
        <option value="{{ $CategoryProvider->id }}" {{ $provider->category_id == $CategoryProvider->id ? 'selected' : '' }}>{{$CategoryProvider->name}}</option>
        @endforeach
    </select>
</div>

@else
<div class="form-group">
    <label>نوع الخدمة المقدمة</label>
    <select name="category_id" class="form-control">
        
        @foreach($CategoryProvideres as $CategoryProvider)
    
        <option value="{{$CategoryProvider->id}}">{{$CategoryProvider->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>عدد سنوات الخبرة</label>
    <select name="experience" class="form-control">
        
       
    
        <option value='2'>من 3 الي 5 سنوات</option>
        <option value='3'>من 5 الي 7 سنوات</option>
        <option value='4'>من 7 الي 10 سنوات</option>
        <option value='5'>اكتر من 10 سنوات</option>

      
    </select>
</div>
@endisset







@isset($provider)
<div class="form-group">
    <label>عدد سنوات الخبرة</label>
    <select name="experience" class="form-control">
        
       
    
        <option value='2'>من 3 الي 5 سنوات</option>
        <option value='3'>من 5 الي 7 سنوات</option>
        <option value='4'>من 7 الي 10 سنوات</option>
        <option value='5'>اكتر من 10 سنوات</option>

      
    </select>
</div>
    {{ BsForm::image('avatar')->collection('avatars')->files($provider->getMediaResource('avatars')) }}
    {{ BsForm::image('cv')->collection('cv')->files($provider->getMediaResource('cv')) }}
    {{ BsForm::image('default')->collection('default')->files($provider->getMediaResource('cv')) }}
    

@else

    {{ BsForm::image('avatar')->collection('avatars')->label(trans('provider.attributes.avatar')) }}
    {{ BsForm::image('cv')->collection('cv')->label(trans('provider.attributes.cv')) }}
    {{ BsForm::image('default')->collection('default')->unlimited()->label(trans('provider.attributes.certificate')) }}

@endisset
