<?php

Breadcrumbs::register('admin.listtypes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.listtypes.management'), route('admin.listtypes.index'));
});

Breadcrumbs::register('admin.listtypes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.listtypes.index');
    $breadcrumbs->push(trans('menus.backend.listtypes.create'), route('admin.listtypes.create'));
});

Breadcrumbs::register('admin.listtypes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.listtypes.index');
    $breadcrumbs->push(trans('menus.backend.listtypes.edit'), route('admin.listtypes.edit', $id));
});
