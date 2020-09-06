<?php

Breadcrumbs::register('admin.zclists.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zclists.management'), route('admin.zclists.index'));
});

Breadcrumbs::register('admin.zclists.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zclists.index');
    $breadcrumbs->push(trans('menus.backend.zclists.create'), route('admin.zclists.create'));
});

Breadcrumbs::register('admin.zclists.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zclists.index');
    $breadcrumbs->push(trans('menus.backend.zclists.edit'), route('admin.zclists.edit', $id));
});
