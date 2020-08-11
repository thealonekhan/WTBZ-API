<?php

namespace App\Models\TrackableLog\Traits;

use App\Models\Trackable\Trackable;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Models\TrackableLogType\TrackableLogType;

/**
 * Class TrackableLogRelationship
 */
trait TrackableLogRelationship
{
    /**
     * TrackableLog belongsTo with ZumhiCacheUser.
     */
    public function trackable()
    {
        return $this->belongsTo(Trackable::class, 'trackableCode', 'referenceCode');
    }
    
    /**
     * TrackableLog belongsTo with ZumhiCacheUser.
     */
    public function owner()
    {
        return $this->belongsTo(ZumhiCacheUser::class, 'ownerCode', 'referenceCode');
    }

    /**
     * TrackableLog belongsTo with ZumhiCache.
     */
    public function zumhicache()
    {
        return $this->belongsTo(ZumhiCache::class, 'zumhiCode', 'referenceCode');
    }

    /**
     * TrackableLog belongsTo with ZumhiCacheCoordinate.
     */
    public function coordinate()
    {
        return $this->belongsTo(ZumhiCacheCoordinate::class, 'coordinates_id');
    }

    /**
     * TrackableLog belongsTo with LogType.
     */
    public function trackableLogType()
    {
        return $this->belongsTo(TrackableLogType::class, 'trackableLogTypeId');
    }
}
