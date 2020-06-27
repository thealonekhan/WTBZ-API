<?php

Breadcrumbs::register('admin.zumhicaches.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.zumhicaches.management'), route('admin.zumhicaches.index'));
});

Breadcrumbs::register('admin.zumhicaches.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.zumhicaches.index');
    $breadcrumbs->push(trans('menus.backend.zumhicaches.create'), route('admin.zumhicaches.create'));
});

Breadcrumbs::register('admin.zumhicaches.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.zumhicaches.index');
    $breadcrumbs->push(trans('menus.backend.zumhicaches.edit'), route('admin.zumhicaches.edit', $id));
});
