@component('dashboard::components.sidebarItem')
 
    @slot('url', route('dashboard.coupons.index'))
    @slot('name', trans('coupons.plural'))
    @slot('active', request()->routeIs('*coupons*'))
    @slot('icon', 'fas fa-th')
    @slot('tree', [
        [
            'name' => trans('coupons.actions.list'),
            'url' => route('dashboard.coupons.index'),
         
            'active' => request()->routeIs('*coupons.index')
            || request()->routeIs('*coupons.show'),
        ],
        [
            'name' => trans('coupons.actions.create'),
            'url' => route('dashboard.coupons.create'),
            
            'active' => request()->routeIs('*coupons.create'),
        ],
    ])
@endcomponent
