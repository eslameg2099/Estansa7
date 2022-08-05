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
