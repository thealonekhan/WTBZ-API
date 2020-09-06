<?php

Breadcrumbs::register('admin.listzumhicaches.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.listzumhicaches.management'), route('admin.listzumhicaches.index'));
});

Breadcrumbs::register('admin.listzumhicaches.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.listzumhicaches.index');
    $breadcrumbs->push(trans('menus.backend.listzumhicaches.create'), route('admin.listzumhicaches.create'));
});

Breadcrumbs::register('admin.listzumhicaches.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.listzumhicaches.index');
    $breadcrumbs->push(trans('menus.backend.listzumhicaches.edit'), route('admin.listzumhicaches.edit', $id));
});
