@include('dashboard.errors')

{{ BsForm::text('titele')->label(trans('posts.attributes.titele')) }}
{{ BsForm::text('slug')->label(trans('posts.attributes.slug')) }}
<div class="form-group">
    <label>الناشر</label>
    <select name="user_id" class="form-control">
    <option selected="selected" value="">
اختر
</option>
        @foreach($Providers as $Provider)
        <option value="{{$Provider->id}}">{{$Provider->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>النوع</label>
    
    <select name="category_id" class="form-control">
    <option selected="selected" value="">
اختر
</option>
        @foreach($CategoryPosts as $CategoryPost)
        <option value="{{$CategoryPost->id}}">{{$CategoryPost->name}}</option>
        @endforeach
    </select>
</div>


{{ BsForm::textarea('description')->label(trans('posts.attributes.description')) }}

{{ BsForm::checkbox('stauts')->value(1)->withDefault()->checked($post->stauts ?? old('stauts')) }}

@isset($post)
    {{ BsForm::image('image')->files($post->getMediaResource()) }}
@else
    {{ BsForm::image('image') }}
@endisset


      

