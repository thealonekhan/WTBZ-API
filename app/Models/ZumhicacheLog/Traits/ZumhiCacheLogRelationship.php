<?php

namespace App\Models\ZumhicacheLog\Traits;

use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Models\LogType\LogType;

/**
 * Class ZumhiCacheLogRelationship
 */
trait ZumhiCacheLogRelationship
{
    /**
     * ZumhiCacheLog belongsTo with ZumhiCacheUser.
     */
    public function owner()
    {
        return $this->belongsTo(ZumhiCacheUser::class, 'user_id');
    }

    /**
     * ZumhicacheLog belongsTo with ZumhiCache.
     */
    public function zumhicache()
    {
        return $this->belongsTo(ZumhiCache::class, 'zumhicacheCode', 'referenceCode');
    }

    /**
     * ZumhicacheLog belongsTo with ZumhiCacheCoordinate.
     */
    public function coordinate()
    {
        return $this->belongsTo(ZumhiCacheCoordinate::class, 'coordinates_id');
    }

    /**
     * ZumhicacheLog belongsTo with LogType.
     */
    public function logType()
    {
        return $this->belongsTo(LogType::class, 'logtype_id');
    }
}
