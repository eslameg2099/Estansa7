@include('dashboard.errors')

{{ BsForm::text('titele')->label(trans('posts.attributes.titele')) }}

@isset($post)

<div class="form-group">
    <label>الناشر</label>
    <select name="user_id" class="form-control">
    <option selected="selected" value="">
اختر
</option>
        @foreach($Providers as $Provider)
        <option value="{{ $Provider->id }}" {{ $post->user_id == $Provider->id  ? 'selected' : '' }}>{{$Provider->name}}</option>

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
        <option value="{{ $CategoryPost->id }}" {{ $post->category_id  == $CategoryPost->id  ? 'selected' : '' }}>{{$CategoryPost->name}}</option>

        @endforeach
    </select>
</div>

@else
{{ BsForm::text('slug')->label(trans('posts.attributes.slug')) }}

<div class="form-group">
    <label>الناشر</label>
    <select name="user_id" class="form-control">
    <option selected="selected" value="">
اختر
</option>
        @foreach($Providers as $Provider)
        <option value="{{ $Provider->id}}">{{$Provider->name}}</option>

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
@endisset







{{ BsForm::textarea('description')->attribute('class', 'form-control textarea')->label(trans('posts.attributes.description')) }}

{{ BsForm::checkbox('stauts')->value(1)->withDefault()->checked($post->stauts ?? old('stauts')) }}

@isset($post)
    {{ BsForm::image('image')->files($post->getMediaResource()) }}
@else
    {{ BsForm::image('image') }}
@endisset


      

