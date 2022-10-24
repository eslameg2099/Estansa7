{{ BsForm::resource('reservations')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('reservations.filter'))

    <div class="row">
    <div class="col-md-3">
            {{ BsForm::number('id')->value(request('id'))->label(trans('reservations.attributes.id')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('customer')->value(request('customer'))->label(trans('reservations.attributes.customer')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('provider')->value(request('provider'))->label(trans('reservations.attributes.provider')) }}
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
            @lang('reservations.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
