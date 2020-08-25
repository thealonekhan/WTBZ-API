<?php

namespace App\Models\UserWayPoint\Traits;

use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;

/**
 * Class UserWayPointRelationship
 */
trait UserWayPointRelationship
{
    /**
     * UserWayPoint belongsTo with ZumhiCache.
     */
    public function zumhicache()
    {
        return $this->belongsTo(ZumhiCache::class, 'zumhiCode', 'referenceCode');
    }

    /**
     * UserWayPoint belongsTo with ZumhiCacheCoordinate.
     */
    public function coordinate()
    {
        return $this->belongsTo(ZumhiCacheCoordinate::class, 'coordinates_id');
    }
}
