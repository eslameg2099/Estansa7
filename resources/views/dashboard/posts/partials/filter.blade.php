{{ BsForm::resource('posts')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('posts.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('titele')->value(request('titele'))->label(trans('posts.attributes.titele')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('user_id')->value(request('user_id'))->label(trans('posts.attributes.user_id')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('category_id')->value(request('category_id'))->label(trans('posts.attributes.category_id')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('posts.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('posts.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
