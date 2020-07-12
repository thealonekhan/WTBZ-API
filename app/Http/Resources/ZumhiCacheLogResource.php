<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ZumhiCacheLogResource extends Resource
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
        $updatedCoordinates = [];
        if ($this->coordinate) {
            $updatedCoordinates = [
                'latitude' => $this->coordinate->latitude,
                'longitude' => $this->coordinate->longitude,
            ];
        }
        return [
            'referenceCode'         => $this->referenceCode,
            'ownerCode'             => $this->owner->referenceCode,
            'imageCount'            => 0,
            'loggedDate'            => $this->loggedDate,
            'text'                  => $this->text,
            'geocacheLogType'       => [
                'id'                => $this->logType->id,
                'name'              => $this->logType->name,
                'imageUrl'          => $this->logType->imageUrl,
            ],
            'isEncoded'             => $this->isEncoded,
            'isArchived'            => $this->isArchived,
            'zumhicacheCode'        => $this->zumhicache->referenceCode,
            'zumhicacheName'        => $this->zumhicache->name,
            'ianaTimezoneId'        => $this->zumhicache->ianaTimezoneId,
            'usedFavoritePoint'     => $this->usedFavoritePoint,
            'url'                   => $this->url,
            'owner'                 => [],
            'updatedCoordinates'     => $updatedCoordinates,
        ];
    }
}
