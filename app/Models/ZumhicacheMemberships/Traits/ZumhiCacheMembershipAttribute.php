<?php

namespace App\Models\ZumhicacheMemberships\Traits;

/**
 * Class ZumhiCacheMembershipAttribute.
 */
trait ZumhiCacheMembershipAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-zumhicachemembership", "admin.zumhicachememberships.edit")}
                {$this->getDeleteButtonAttribute("delete-zumhicachemembership", "admin.zumhicachememberships.destroy")}
                </div>';
    }
}
