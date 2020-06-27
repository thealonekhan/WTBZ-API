<?php

namespace App\Models\ZumhicacheAttributes\Traits;

/**
 * Class ZumhiCacheAttributeAttribute.
 */
trait ZumhiCacheAttributeAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-zumhicacheattribute", "admin.zumhicacheattributes.edit")}
                {$this->getDeleteButtonAttribute("delete-zumhicacheattribute", "admin.zumhicacheattributes.destroy")}
                </div>';
    }
}
