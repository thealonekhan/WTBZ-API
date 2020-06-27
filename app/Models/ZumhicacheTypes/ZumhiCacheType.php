<?php

namespace App\Models\ZumhicacheTypes;

use App\Models\ModelTrait;
use App\Models\BaseModel;
use App\Models\ZumhicacheTypes\Traits\ZumhiCacheTypeAttribute;
use App\Models\ZumhicacheTypes\Traits\ZumhiCacheTypeRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZumhiCacheType extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        ZumhiCacheTypeAttribute,
    	ZumhiCacheTypeRelationship {
            // ZumhiCacheTypeAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/6.x/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'zumhicachetypes';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
