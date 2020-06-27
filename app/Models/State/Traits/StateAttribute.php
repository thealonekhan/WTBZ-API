<?php

namespace App\Models\State\Traits;

/**
 * Class StateAttribute.
 */
trait StateAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-state", "admin.states.edit")}
                {$this->getDeleteButtonAttribute("delete-state", "admin.states.destroy")}
                </div>';
    }
}
