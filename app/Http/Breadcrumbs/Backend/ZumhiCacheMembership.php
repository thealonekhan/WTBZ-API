<?php

Breadcrumbs::register('admin.zumhicachememberships.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicachememberships.management'), route('admin.zumhicachememberships.index'));
});

Breadcrumbs::register('admin.zumhicachememberships.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicachememberships.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachememberships.create'), route('admin.zumhicachememberships.create'));
});

Breadcrumbs::register('admin.zumhicachememberships.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicachememberships.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachememberships.edit'), route('admin.zumhicachememberships.edit', $id));
});
