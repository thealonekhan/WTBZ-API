<?php

Breadcrumbs::register('admin.zumhicacheusers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicacheusers.management'), route('admin.zumhicacheusers.index'));
});

Breadcrumbs::register('admin.zumhicacheusers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicacheusers.index');
    $breadcrumbs->push(trans('menus.backend.zumhicacheusers.create'), route('admin.zumhicacheusers.create'));
});

Breadcrumbs::register('admin.zumhicacheusers.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicacheusers.index');
    $breadcrumbs->push(trans('menus.backend.zumhicacheusers.edit'), route('admin.zumhicacheusers.edit', $id));
});
