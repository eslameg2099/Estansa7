<?php

Breadcrumbs::for('dashboard.home', function ($breadcrumb) {
    $breadcrumb->push(trans('dashboard.home'), route('dashboard.home'));
});

Breadcrumbs::for('dashboard.categoryprovider.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('categoryprovider.plural'), route('dashboard.categoryprovider.index'));
});

Breadcrumbs::for('dashboard.categoryprovider.trashed', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.categoryprovider.index');
    $breadcrumb->push(trans('categoryprovider.trashed'), route('dashboard.categoryprovider.trashed'));
});

Breadcrumbs::for('dashboard.categoryprovider.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.categoryprovider.index');
    $breadcrumb->push(trans('categoryprovider.create'), route('dashboard.categoryprovider.create'));
});

Breadcrumbs::for('dashboard.categoryprovider.show', function ($breadcrumb, $customer) {
    $breadcrumb->parent('dashboard.categoryprovider.index');
    $breadcrumb->push($customer->name, route('dashboard.categoryprovider.show', $customer));
});

Breadcrumbs::for('dashboard.categoryprovider.edit', function ($breadcrumb, $customer) {
    $breadcrumb->parent('dashboard.categoryprovider.show', $customer);
    $breadcrumb->push(trans('categoryprovider.edit'), route('dashboard.categoryprovider.edit', $customer));
});


Breadcrumbs::for('dashboard.categorypost.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('categorypost.plural'), route('dashboard.categorypost.index'));
});

Breadcrumbs::for('dashboard.categorypost.show', function ($breadcrumb, $model) {
    $breadcrumb->parent('dashboard.categorypost.index');
    $breadcrumb->push($model->name, route('dashboard.categorypost.show', $model));
});

Breadcrumbs::for('dashboard.categorypost.edit', function ($breadcrumb, $model) {
    $breadcrumb->parent('dashboard.categorypost.show', $model);
    $breadcrumb->push(trans('categorypost.edit'), route('dashboard.categorypost.edit', $model));
});


Breadcrumbs::for('dashboard.posts.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('posts.plural'), route('dashboard.posts.index'));
});

Breadcrumbs::for('dashboard.posts.show', function ($breadcrumb, $model) {
    $breadcrumb->parent('dashboard.posts.index');
    $breadcrumb->push($model->titele, route('dashboard.posts.show', $model));
});


Breadcrumbs::for('dashboard.posts.edit', function ($breadcrumb, $model) {
    $breadcrumb->parent('dashboard.posts.show', $model);
    $breadcrumb->push(trans('posts.edit'), route('dashboard.posts.edit', $model));
});


Breadcrumbs::for('dashboard.posts.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.posts.index');
    $breadcrumb->push(trans('posts.actions.create'), route('dashboard.posts.create'));
});


Breadcrumbs::for('dashboard.reservations.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('reservations.plural'), route('dashboard.reservations.index'));
});

Breadcrumbs::for('dashboard.reservations.show', function ($breadcrumb, $model) {
    $breadcrumb->parent('dashboard.reservations.index');
    $breadcrumb->push($model->id, route('dashboard.reservations.show', $model));
});


Breadcrumbs::for('dashboard.providers.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('provider.plural'), route('dashboard.providers.index'));
});



Breadcrumbs::for('dashboard.providers.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.providers.index');
    $breadcrumb->push(trans('provider.actions.create'), route('dashboard.providers.create'));
});

Breadcrumbs::for('dashboard.providers.show', function ($breadcrumb, $provider) {
    $breadcrumb->parent('dashboard.providers.index');
    $breadcrumb->push($provider->name, route('dashboard.providers.show', $provider));
});

Breadcrumbs::for('dashboard.providers.edit', function ($breadcrumb, $provider) {
    $breadcrumb->parent('dashboard.providers.show', $provider);
    $breadcrumb->push(trans('provider.actions.edit'), route('dashboard.providers.edit', $provider));
});




Breadcrumbs::for('dashboard.coupons.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('coupons.plural'), route('dashboard.coupons.index'));
});

Breadcrumbs::for('dashboard.coupons.trashed', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.coupons.index');
    $breadcrumb->push(trans('coupons.trashed'), route('dashboard.coupons.trashed'));
});

Breadcrumbs::for('dashboard.coupons.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.coupons.index');
    $breadcrumb->push(trans('coupons.actions.create'), route('dashboard.coupons.create'));
});

Breadcrumbs::for('dashboard.coupons.show', function ($breadcrumb, $coupon) {
    $breadcrumb->parent('dashboard.coupons.index');
    $breadcrumb->push($coupon->code, route('dashboard.coupons.show', $coupon));
});

Breadcrumbs::for('dashboard.coupons.edit', function ($breadcrumb, $coupon) {
    $breadcrumb->parent('dashboard.coupons.show', $coupon);
    $breadcrumb->push(trans('coupons.actions.edit'), route('dashboard.coupons.edit', $coupon));
});