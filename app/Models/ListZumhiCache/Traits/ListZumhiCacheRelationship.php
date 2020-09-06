<?php

namespace App\Models\ListZumhiCache\Traits;

use App\Models\Zumhicache\ZumhiCache;
use App\Models\ZCList\ZCList;

/**
 * Class ListZumhiCacheRelationship
 */
trait ListZumhiCacheRelationship
{
    /**
     * ListZumhiCache belongsTo with ZumhiCache.
     */
    public function zumhicache()
    {
        return $this->belongsTo(ZumhiCache::class, 'zumhiCode', 'referenceCode');
    }
    
    /**
     * ListZumhiCache belongsTo with List.
     */
    public function ZCList()
    {
        return $this->belongsTo(ZCList::class, 'listCode', 'referenceCode');
    }


}
