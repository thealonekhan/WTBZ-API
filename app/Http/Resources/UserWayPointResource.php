<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWayPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
            'referenceCode'             => $this->referenceCode,
            'description'               => $this->description,
            'isCorrectedCoordinates'    => $this->isCorrectedCoordinates,
            'coordinates'               => $updatedCoordinates,
            'zumhicacheCode'            => $this->zumhicache->referenceCode,
        ];
    }
}
