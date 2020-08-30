<?php

namespace App\Models\TourMapZumhicache;

use App\Models\BaseModel;

class TourMapZumhiCache extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tour_map_zumhi_caches';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}