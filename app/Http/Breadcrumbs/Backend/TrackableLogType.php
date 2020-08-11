<?php

Breadcrumbs::register('admin.trackablelogtypes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.trackablelogtypes.management'), route('admin.trackablelogtypes.index'));
});

Breadcrumbs::register('admin.trackablelogtypes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.trackablelogtypes.index');
    $breadcrumbs->push(trans('menus.backend.trackablelogtypes.create'), route('admin.trackablelogtypes.create'));
});

Breadcrumbs::register('admin.trackablelogtypes.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.trackablelogtypes.index');
    $breadcrumbs->push(trans('menus.backend.trackablelogtypes.edit'), route('admin.trackablelogtypes.edit', $id));
});
