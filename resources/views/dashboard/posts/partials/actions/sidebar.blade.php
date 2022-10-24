@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.posts.index'))
    @slot('name', ' المقالات')
    @slot('icon', 'fas fa-pencil-ruler')
    @slot('tree', [
        [
            'name' => trans('posts.actions.list'),
            'url' => route('dashboard.posts.index'),
        
        ],
        [
            'name' => ' اضافة مقال',
            'url' => route('dashboard.posts.create'),
        ],
    ])
@endcomponent
