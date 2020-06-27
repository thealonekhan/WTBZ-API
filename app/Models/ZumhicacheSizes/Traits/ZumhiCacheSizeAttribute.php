<?php

namespace App\Models\ZumhicacheSizes\Traits;

/**
 * Class ZumhiCacheSizeAttribute.
 */
trait ZumhiCacheSizeAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-zumhicachesize", "admin.zumhicachesizes.edit")}
                {$this->getDeleteButtonAttribute("delete-zumhicachesize", "admin.zumhicachesizes.destroy")}
                </div>';
    }
}
