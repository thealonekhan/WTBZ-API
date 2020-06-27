<?php

Breadcrumbs::register('admin.statuses.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.statuses.management'), route('admin.statuses.index'));
});

Breadcrumbs::register('admin.statuses.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.statuses.index');
    $breadcrumbs->push(trans('menus.backend.statuses.create'), route('admin.statuses.create'));
});

Breadcrumbs::register('admin.statuses.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.statuses.index');
    $breadcrumbs->push(trans('menus.backend.statuses.edit'), route('admin.statuses.edit', $id));
});
