@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.categoryprovider.index'))
    @slot('name', 'انواع الاقسام')
    @slot('icon', 'fab fa-typo3')
    @slot('tree', [
        [
            'name' => trans('categoryprovider.actions.list'),
            'url' => route('dashboard.categoryprovider.index'),
        
        ],
        [
            'name' => ' اضافة قسم',
            'url' => route('dashboard.categoryprovider.create'),
        ],
    ])
@endcomponent
