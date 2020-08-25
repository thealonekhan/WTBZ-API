<?php

Breadcrumbs::register('admin.userwaypoints.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.userwaypoints.management'), route('admin.userwaypoints.index'));
});

Breadcrumbs::register('admin.userwaypoints.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.userwaypoints.index');
    $breadcrumbs->push(trans('menus.backend.userwaypoints.create'), route('admin.userwaypoints.create'));
});

Breadcrumbs::register('admin.userwaypoints.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.userwaypoints.index');
    $breadcrumbs->push(trans('menus.backend.userwaypoints.edit'), route('admin.userwaypoints.edit', $id));
});
