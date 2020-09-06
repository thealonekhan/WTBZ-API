<?php

namespace App\Models\ZCList\Traits;

use App\Models\ZumhicacheUser\ZumhiCacheUser;
use App\Models\ListZumhiCache\ListZumhiCache;
use App\Models\ListType\ListType;

/**
 * Class ZCListRelationship
 */
trait ZCListRelationship
{
    /**
     * List belongsTo with ZumhiCacheUser.
     */
    public function owner()
    {
        return $this->belongsTo(ZumhiCacheUser::class, 'ownerCode', 'referenceCode');
    }
    
    /**
     * List belongsTo with ListTypes.
     */
    public function listtype()
    {
        return $this->belongsTo(ListType::class, 'listtype_id');
    }

    /**
     * List has many relationship with ListZumhiCache.
     */
    public function listzumhicache()
    {
        return $this->hasMany(ListZumhiCache::class, 'listCode', 'referenceCode');
    }
}
