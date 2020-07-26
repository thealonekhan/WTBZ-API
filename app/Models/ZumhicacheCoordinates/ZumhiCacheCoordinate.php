<?php

namespace App\Models\ZumhicacheCoordinates;

use App\Models\ModelTrait;
use App\Models\BaseModel;
use App\Models\ZumhicacheCoordinates\Traits\ZumhiCacheCoordinateAttribute;
use App\Models\ZumhicacheCoordinates\Traits\ZumhiCacheCoordinateRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZumhiCacheCoordinate extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        ZumhiCacheCoordinateAttribute,
    	ZumhiCacheCoordinateRelationship {
            // ZumhiCacheCoordinateAttribute::getEditButtonAttribute insteadof ModelTrait;
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
    // protected $fillable = [

    // ];

    /**
     * Default values for model fields
     * @var array
     */
    // protected $attributes = [

    // ];

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
        $this->table = config('module.zumhicachecoordinates.table');
    }

    public function getFullNameAttribute()
    {
        return 'lat: '.$this->latitude . ", long: " . $this->longitude;
    }
}
