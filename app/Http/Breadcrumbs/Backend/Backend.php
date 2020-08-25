<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(__('navs.backend.dashboard'), route('admin.dashboard'));
});

require __DIR__.'/Search.php';
require __DIR__.'/Access/User.php';
require __DIR__.'/Access/Role.php';
require __DIR__.'/Access/Permission.php';
require __DIR__.'/Page.php';
require __DIR__.'/Setting.php';
require __DIR__.'/Blog_Category.php';
require __DIR__.'/Blog_Tag.php';
require __DIR__.'/Blog_Management.php';
require __DIR__.'/Faqs.php';
require __DIR__.'/Menu.php';
require __DIR__.'/LogViewer.php';

require __DIR__.'/ZumhiCache.php';
require __DIR__.'/Country.php';
require __DIR__.'/State.php';
require __DIR__.'/ZumhiCacheType.php';
require __DIR__.'/ZumhiCacheSize.php';
require __DIR__.'/ZumhiCacheUser.php';
require __DIR__.'/ZumhiCacheCoordinate.php';
require __DIR__.'/ZumhiCacheAttribute.php';
require __DIR__.'/ZumhiCacheMembership.php';
require __DIR__.'/Status.php';
require __DIR__.'/ZumhiCacheAttributeType.php';
require __DIR__.'/ZumhiCacheLog.php';
require __DIR__.'/LogType.php';
require __DIR__.'/Trackable.php';
require __DIR__.'/TrackableLog.php';
require __DIR__.'/TrackableLogType.php';
require __DIR__.'/UserWayPoint.php';