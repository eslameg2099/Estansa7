@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.home'))
    @slot('name', trans('dashboard.home'))
    @slot('icon', 'fas fa-tachometer-alt')
    @slot('active', request()->routeIs('dashboard.home'))
@endcomponent

@include('dashboard.accounts.sidebar')
@include('dashboard.categoryprovider.partials.actions.sidebar')
@include('dashboard.categorypost.partials.actions.sidebar')
@include('dashboard.posts.partials.actions.sidebar')
@include('dashboard.reservations.partials.actions.sidebar')

@include('dashboard.coupons.partials.actions.sidebar')

{{-- The sidebar of generated crud will set here: Don't remove this line --}}
@include('dashboard.feedback.partials.actions.sidebar')
@include('dashboard.settings.sidebar')
