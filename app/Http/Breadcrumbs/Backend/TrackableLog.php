<?php

Breadcrumbs::register('admin.trackablelogs.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.trackablelogs.management'), route('admin.trackablelogs.index'));
});

Breadcrumbs::register('admin.trackablelogs.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.trackablelogs.index');
    $breadcrumbs->push(trans('menus.backend.trackablelogs.create'), route('admin.trackablelogs.create'));
});

Breadcrumbs::register('admin.trackablelogs.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.trackablelogs.index');
    $breadcrumbs->push(trans('menus.backend.trackablelogs.edit'), route('admin.trackablelogs.edit', $id));
});
