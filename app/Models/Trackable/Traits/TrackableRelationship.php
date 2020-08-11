<?php

namespace App\Models\Trackable\Traits;
use App\Models\Country\Country;
use App\Models\LogType\LogType;
use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\Zumhicache\ZumhiCache;

/**
 * Class TrackableRelationship
 */
trait TrackableRelationship
{
    /*
    * put you model relationships here
    * Take below example for reference
    */
    /*
    public function users() {
        //Note that the below will only work if user is represented as user_id in your table
        //otherwise you have to provide the column name as a parameter
        //see the documentation here : https://laravel.com/docs/6.x/eloquent-relationships
        $this->belongsTo(User::class);
    }
     */

    /**
     * Trackable belongsTo with Country.
    */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Trackable owner belongsTo with ZumhiCacheUser.
     */
    public function owner()
    {
        return $this->belongsTo(ZumhiCacheUser::class, 'ownerCode', 'referenceCode');
    }
    
    /**
     * Trackable holder belongsTo with ZumhiCacheUser.
     */
    public function holder()
    {
        return $this->belongsTo(ZumhiCacheUser::class, 'holderCode', 'referenceCode');
    }
    
    /**
     * Trackable holder belongsTo with ZumhiCache.
     */
    public function zumhicache()
    {
        return $this->belongsTo(ZumhiCache::class, 'zumhiCode', 'referenceCode');
    }
    
    /**
     * Trackable holder belongsTo with Logtypes.
     */
    public function type()
    {
        return $this->belongsTo(LogType::class, 'type_id');
    }
}
