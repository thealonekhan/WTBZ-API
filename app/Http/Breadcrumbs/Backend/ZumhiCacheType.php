<?php

Breadcrumbs::register('admin.zumhicachetypes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicachetypes.management'), route('admin.zumhicachetypes.index'));
});

Breadcrumbs::register('admin.zumhicachetypes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicachetypes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachetypes.create'), route('admin.zumhicachetypes.create'));
});

Breadcrumbs::register('admin.zumhicachetypes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicachetypes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachetypes.edit'), route('admin.zumhicachetypes.edit', $id));
});
