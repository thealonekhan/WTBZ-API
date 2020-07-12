<?php

namespace App\Models\LogType\Traits;

/**
 * Class LogTypeAttribute.
 */
trait LogTypeAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-logtype", "admin.logtypes.edit")}
                {$this->getDeleteButtonAttribute("delete-logtype", "admin.logtypes.destroy")}
                </div>';
    }
}
