{{ BsForm::resource('providers')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('provider.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name'))->label(trans('provider.attributes.name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('email')->value(request('email'))->label(trans('provider.attributes.email')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('phone')->value(request('phone'))->label(trans('provider.attributes.phone')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('provider.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('provider.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
