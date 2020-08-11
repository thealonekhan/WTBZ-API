<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TrackableLogResource extends Resource
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
        $trackableLogType = [];
        $owner = [];
        if ($this->coordinate) {
            $updatedCoordinates = [
                'latitude' => $this->coordinate->latitude,
                'longitude' => $this->coordinate->longitude,
            ];
        }
        if ($this->trackableLogType) {
            $trackableLogType = [
                'id' => $this->trackableLogType->id,
                'name' => $this->trackableLogType->name,
            ];
        }
        if ($this->owner) {
            $owner = [
                'referenceCode'     => $this->owner->referenceCode,
                'username'          => $this->owner->owner->username,
                'membershipLevelId' => $this->owner->membership->id,
                'avatarUrl'         => $this->owner->avatarUrl,
                'profileText'       => $this->owner->profileText,
            ];
        }
        return [
            'referenceCode'         => $this->referenceCode,
            'ownerCode'             => $this->owner->referenceCode,
            'trackableCode'         => $this->trackable->referenceCode,
            'zumhicacheCode'        => $this->zumhicache->referenceCode,
            'zumhicacheName'        => $this->zumhicache->name,
            'logDate'               => $this->logDate,
            'text'                  => $this->text,
            'imageCount'            => 0,
            'isRot13Encoded'        => $this->isRot13Encoded,
            'trackableLogType'      => $trackableLogType,
            'coordinates'           => $updatedCoordinates,
            'trackingNumber'        => $this->trackingNumber,
            'url'                   => $this->url,
            'owner'                 => $owner,
        ];
    }
}
