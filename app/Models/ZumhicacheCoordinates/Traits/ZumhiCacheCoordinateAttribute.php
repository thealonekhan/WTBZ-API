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
        return '<div class="btn-group action-btn">
            '.$this->getViewButtonAttribute().'
            '.$this->getEditButtonAttribute('edit-zumhicachecoordinate', 'admin.zumhicachecoordinates.edit').'
            '.$this->getDeleteButtonAttribute('delete-zumhicachecoordinate', 'admin.zumhicachecoordinates.destroy').'
        </div>';
    }

    /**
     * @return string
     */
    public function getViewButtonAttribute()
    {
        return '<a target="_self" href="'.route('admin.zumhicachecoordinates.show', $this->id).'" class="btn btn-flat btn-default">
                    <i data-toggle="tooltip" data-placement="top" title="Details" class="fa fa-eye"></i>
                </a>';
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status_id == 1;
    }
}
