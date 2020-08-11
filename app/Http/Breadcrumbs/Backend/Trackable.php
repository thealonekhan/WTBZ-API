<?php

Breadcrumbs::register('admin.trackables.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.trackables.management'), route('admin.trackables.index'));
});

Breadcrumbs::register('admin.trackables.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.trackables.index');
    $breadcrumbs->push(trans('menus.backend.trackables.create'), route('admin.trackables.create'));
});

Breadcrumbs::register('admin.trackables.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.trackables.index');
    $breadcrumbs->push(trans('menus.backend.trackables.edit'), route('admin.trackables.edit', $id));
});
