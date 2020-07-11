<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ZumhiCacheAttributeTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'attribute_id'      => $this->attribute_id,
            'name'              => $this->name,
            'hasYesOption'      => $this->hasYesOption,
            'hasNoOption'       => $this->hasNoOption,
            'yesIconUrl'        => $this->yesIconUrl,
            'noIconUrl'         => $this->noIconUrl,
            'notChosenIconUrl'  => $this->notChosenIconUrl,
            'created_at'        => optional($this->created_at)->toDateString(),
            // 'updated_at'        => optional($this->updated_at)->toDateString(),
        ];
    }
}
