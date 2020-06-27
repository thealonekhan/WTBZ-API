<?php

namespace App\Models\ZumhicacheTypes\Traits;

/**
 * Class ZumhiCacheTypeAttribute.
 */
trait ZumhiCacheTypeAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-zumhicachetype", "admin.zumhicachetypes.edit")}
                {$this->getDeleteButtonAttribute("delete-zumhicachetype", "admin.zumhicachetypes.destroy")}
                </div>';
    }
}
