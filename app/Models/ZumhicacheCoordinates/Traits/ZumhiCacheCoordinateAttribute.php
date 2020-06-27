<?php

namespace App\Models\ZumhicacheCoordinates\Traits;

/**
 * Class ZumhiCacheCoordinateAttribute.
 */
trait ZumhiCacheCoordinateAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-zumhicachecoordinate", "admin.zumhicachecoordinates.edit")}
                {$this->getDeleteButtonAttribute("delete-zumhicachecoordinate", "admin.zumhicachecoordinates.destroy")}
                </div>';
    }
}
