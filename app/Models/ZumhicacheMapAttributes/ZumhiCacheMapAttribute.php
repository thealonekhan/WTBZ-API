<?php

namespace App\Models\ZumhicacheMapAttributes;

use App\Models\BaseModel;

class ZumhiCacheMapAttribute extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zumhicache_map_attributes';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}