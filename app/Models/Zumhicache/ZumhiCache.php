<?php

namespace App\Models\Zumhicache;

use App\Models\BaseModel;
use App\Models\Zumhicache\Traits\ZumhiCacheAttribute;
use App\Models\Zumhicache\Traits\ZumhiCacheRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZumhiCache extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        ZumhiCacheAttribute,
    	ZumhiCacheRelationship {
            // ZumhiCacheAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table;

    /**
     * Mass Assignable fields of model
     * @var array
     */
    //protected $fillable = [];

    protected $dates = [
        'created_at', 
        'updated_at',
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.zumhicaches.table');
    }
}
