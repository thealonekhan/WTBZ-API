<?php

Breadcrumbs::register('admin.countries.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.countries.management'), route('admin.countries.index'));
});

Breadcrumbs::register('admin.countries.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.countries.index');
    $breadcrumbs->push(trans('menus.backend.countries.create'), route('admin.countries.create'));
});

Breadcrumbs::register('admin.countries.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.countries.index');
    $breadcrumbs->push(trans('menus.backend.countries.edit'), route('admin.countries.edit', $id));
});
