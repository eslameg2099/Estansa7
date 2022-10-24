@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.categorypost.index'))
    @slot('name', ' انواع اقسام المقالات')
    @slot('icon', 'fab fa-typo3')
    @slot('tree', [
        [
            'name' => trans('categorypost.actions.list'),
            'url' => route('dashboard.categorypost.index'),
        
        ],
        [
            'name' => ' اضافة قسم',
            'url' => route('dashboard.categorypost.create'),
        ],
    ])
@endcomponent
