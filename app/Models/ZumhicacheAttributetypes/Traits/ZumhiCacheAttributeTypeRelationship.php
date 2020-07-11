<?php

namespace App\Models\ZumhicacheAttributetypes\Traits;

use App\Models\ZumhicacheAttributes\ZumhiCacheAttribute;

/**
 * Class ZumhiCacheAttributeTypeRelationship
 */
trait ZumhiCacheAttributeTypeRelationship
{
    /**
     * Zumhicache Attribute Type belongsTo Zumhicache Attribute.
     */
    public function attribute()
    {
        return $this->belongsTo(ZumhiCacheAttribute::class);
    }
}
