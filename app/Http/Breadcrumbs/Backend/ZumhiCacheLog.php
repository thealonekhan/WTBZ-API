<?php

Breadcrumbs::register('admin.zumhicachelogs.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicachelogs.management'), route('admin.zumhicachelogs.index'));
});

Breadcrumbs::register('admin.zumhicachelogs.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicachelogs.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachelogs.create'), route('admin.zumhicachelogs.create'));
});

Breadcrumbs::register('admin.zumhicachelogs.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicachelogs.index');
    $breadcrumbs->push(trans('menus.backend.zumhicachelogs.edit'), route('admin.zumhicachelogs.edit', $id));
});
