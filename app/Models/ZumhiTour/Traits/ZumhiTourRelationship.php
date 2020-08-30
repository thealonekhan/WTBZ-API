<?php

namespace App\Models\ZumhiTour\Traits;

use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Models\Sponsor\Sponsor;

/**
 * Class ZumhiTourRelationship
 */
trait ZumhiTourRelationship
{
    /**
     * ZumhiTour belongsTo with ZumhiCacheCoordinate.
     */
    public function coordinates()
    {
        return $this->belongsTo(ZumhiCacheCoordinate::class, 'coordinates_id');
    }

    /**
     * ZumhiTour belongsTo with Sponsor.
     */
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }

    /**
     * ZumhiTour has many relationship with ZumhiCache.
     */
    public function zumhicaches()
    {
        return $this->belongsToMany(ZumhiCache::class, 'tour_map_zumhi_caches', 'tour_id', 'zumhicache_id');
    }
}
