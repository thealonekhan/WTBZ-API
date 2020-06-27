<?php

Breadcrumbs::register('admin.zumhicacheattributes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicacheattributes.management'), route('admin.zumhicacheattributes.index'));
});

Breadcrumbs::register('admin.zumhicacheattributes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicacheattributes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicacheattributes.create'), route('admin.zumhicacheattributes.create'));
});

Breadcrumbs::register('admin.zumhicacheattributes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicacheattributes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicacheattributes.edit'), route('admin.zumhicacheattributes.edit', $id));
});
