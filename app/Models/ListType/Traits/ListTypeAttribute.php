<?php

namespace App\Models\ListType\Traits;

/**
 * Class ListTypeAttribute.
 */
trait ListTypeAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-listtype", "admin.listtypes.edit")}
                {$this->getDeleteButtonAttribute("delete-listtype", "admin.listtypes.destroy")}
                </div>';
    }
}
