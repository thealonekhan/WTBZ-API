<?php

Breadcrumbs::register('admin.zumhicacheattributetypes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicacheattributetypes.management'), route('admin.zumhicacheattributetypes.index'));
});

Breadcrumbs::register('admin.zumhicacheattributetypes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicacheattributetypes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicacheattributetypes.create'), route('admin.zumhicacheattributetypes.create'));
});

Breadcrumbs::register('admin.zumhicacheattributetypes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicacheattributetypes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicacheattributetypes.edit'), route('admin.zumhicacheattributetypes.edit', $id));
});
