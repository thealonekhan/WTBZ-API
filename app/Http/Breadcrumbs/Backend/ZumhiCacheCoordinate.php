<?php

Breadcrumbs::register('admin.zumhicachecoordinates.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicachecoordinates.management'), route('admin.zumhicachecoordinates.index'));
});

Breadcrumbs::register('admin.zumhicachecoordinates.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicachecoordinates.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachecoordinates.create'), route('admin.zumhicachecoordinates.create'));
});

Breadcrumbs::register('admin.zumhicachecoordinates.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicachecoordinates.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachecoordinates.edit'), route('admin.zumhicachecoordinates.edit', $id));
});
