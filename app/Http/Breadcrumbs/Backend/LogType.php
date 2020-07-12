<?php

Breadcrumbs::register('admin.logtypes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.logtypes.management'), route('admin.logtypes.index'));
});

Breadcrumbs::register('admin.logtypes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.logtypes.index');
    $breadcrumbs->push(trans('menus.backend.logtypes.create'), route('admin.logtypes.create'));
});

Breadcrumbs::register('admin.logtypes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.logtypes.index');
    $breadcrumbs->push(trans('menus.backend.logtypes.edit'), route('admin.logtypes.edit', $id));
});
