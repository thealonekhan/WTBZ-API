<?php

namespace App\Models\ZumhicacheUser\Traits;

use App\Models\Access\User\User;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;
use App\Models\ZumhicacheMemberships\ZumhiCacheMembership;

/**
 * Class ZumhiCacheUserRelationship
 */
trait ZumhiCacheUserRelationship
{

     /**
     * ZumhicacheUser belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Zumhicache belongsTo with ZumhiCacheCoordinate.
     */
    public function membership()
    {
        return $this->belongsTo(ZumhiCacheMembership::class, 'membership_id');
    }

    /**
     * Zumhicache belongsTo with ZumhiCacheCoordinate.
     */
    public function coordinate()
    {
        return $this->belongsTo(ZumhiCacheCoordinate::class, 'coordinates_id');
    }
}
