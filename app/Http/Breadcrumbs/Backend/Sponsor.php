<?php

Breadcrumbs::register('admin.sponsors.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.sponsors.management'), route('admin.sponsors.index'));
});

Breadcrumbs::register('admin.sponsors.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.sponsors.index');
    $breadcrumbs->push(trans('menus.backend.sponsors.create'), route('admin.sponsors.create'));
});

Breadcrumbs::register('admin.sponsors.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.sponsors.index');
    $breadcrumbs->push(trans('menus.backend.sponsors.edit'), route('admin.sponsors.edit', $id));
});
