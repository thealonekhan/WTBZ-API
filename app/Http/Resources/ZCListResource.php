<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ZCListResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'referenceCode'         => $this->referenceCode,
            'createdDateUtc'        => $this->createdDateUtc,
            'lastUpdatedDateUtc'    => $this->lastUpdatedDateUtc,
            'name'                  => $this->name,
            'count'                 => count($this->listzumhicache),
            'findCount'             => 0,
            'ownerCode'             => $this->ownerCode,
            'description'           => $this->description,
            'typeId'                => $this->listtype_id,
            'isShared'              => $this->isShared,
            'isPublic'              => $this->isPublic,
            'url'                   => $this->url,
        ];
    }
}
