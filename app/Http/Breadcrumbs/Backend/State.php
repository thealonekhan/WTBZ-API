<?php

Breadcrumbs::register('admin.states.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.states.management'), route('admin.states.index'));
});

Breadcrumbs::register('admin.states.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.states.index');
    $breadcrumbs->push(trans('menus.backend.states.create'), route('admin.states.create'));
});

Breadcrumbs::register('admin.states.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.states.index');
    $breadcrumbs->push(trans('menus.backend.states.edit'), route('admin.states.edit', $id));
});
