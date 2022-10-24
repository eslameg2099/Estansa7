@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.reservations.index'))
    @slot('name', 'الاستشارات')
    @slot('icon', 'fab fa-algolia')
    @slot('tree', [
        [
            'name' => trans('reservations.actions.list'),
            'url' => route('dashboard.reservations.index'),
        
        ],
       
    ])
@endcomponent
