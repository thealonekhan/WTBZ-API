<?php

namespace App\Models\Zumhicache\Traits;

use App\Models\ZumhiCacheUser\ZumhiCacheUser;
use App\Models\ZumhiCacheTypes\ZumhiCacheType;
use App\Models\ZumhiCacheSizes\ZumhiCacheSize;
use App\Models\Country\Country;
use App\Models\State\State;
use App\Models\Status\Status;
use App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate;

/**
 * Class ZumhiCacheRelationship
 */
trait ZumhiCacheRelationship
{
    /*
    * put you model relationships here
    * Take below example for reference
    */


    /**
     * Zumhicache belongsTo with ZumhiCacheUser.
     */
    public function owner()
    {
        return $this->belongsTo(ZumhiCacheUser::class, 'user_id');
    }

    /**
     * Zumhicache belongsTo with ZumhiCacheType.
     */
    public function type()
    {
        return $this->belongsTo(ZumhiCacheType::class, 'type_id');
    }

    /**
     * Zumhicache belongsTo with ZumhiCacheSize.
     */
    public function size()
    {
        return $this->belongsTo(ZumhiCacheSize::class, 'size_id');
    }

    /**
     * Zumhicache belongsTo with Country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Zumhicache belongsTo with State.
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Zumhicache belongsTo with State.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * Zumhicache belongsTo with ZumhiCacheCoordinate.
     */
    public function coordinate()
    {
        return $this->belongsTo(ZumhiCacheCoordinate::class, 'coordinates_id');
    }



}
