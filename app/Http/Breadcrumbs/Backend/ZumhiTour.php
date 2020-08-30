<?php

Breadcrumbs::register('admin.zumhitours.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhitours.management'), route('admin.zumhitours.index'));
});

Breadcrumbs::register('admin.zumhitours.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhitours.index');
    $breadcrumbs->push(trans('menus.backend.zumhitours.create'), route('admin.zumhitours.create'));
});

Breadcrumbs::register('admin.zumhitours.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhitours.index');
    $breadcrumbs->push(trans('menus.backend.zumhitours.edit'), route('admin.zumhitours.edit', $id));
});
