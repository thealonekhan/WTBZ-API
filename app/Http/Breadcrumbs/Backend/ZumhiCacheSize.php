<?php

Breadcrumbs::register('admin.zumhicachesizes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicachesizes.management'), route('admin.zumhicachesizes.index'));
});

Breadcrumbs::register('admin.zumhicachesizes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicachesizes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachesizes.create'), route('admin.zumhicachesizes.create'));
});

Breadcrumbs::register('admin.zumhicachesizes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicachesizes.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachesizes.edit'), route('admin.zumhicachesizes.edit', $id));
});
