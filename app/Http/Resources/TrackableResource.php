<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TrackableResource extends Resource
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
        $trackableType = [];
        $owner = [];
        $holder = [];
        if ($this->type) {
            $trackableType = [
                'id' => $this->type->id,
                'name' => $this->type->name,
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
        if ($this->holder) {
            $holder = [
                'referenceCode'     => $this->holder->referenceCode,
                'username'          => $this->holder->owner->username,
                'membershipLevelId' => $this->holder->membership->id,
                'avatarUrl'         => $this->holder->avatarUrl,
                'profileText'       => $this->holder->profileText,
            ];
        }
        return [
            'referenceCode'         => $this->referenceCode,
            'iconUrl'               => $this->iconUrl,
            'name'                  => $this->name,
            'imageCount'            => $this->imageCount,
            'goal'                  => $this->goal,
            'description'           => $this->description,
            'releasedDate'          => $this->releasedDate,
            'originCountry'         => $this->country ? $this->country->name : null,
            'ownerCode'             => $this->owner ? $this->owner->referenceCode : null,
            'holderCode'            => $this->holder ? $this->holder->referenceCode : null,
            'inHolderCollection'    => $this->inHolderCollection,
            'currentZumhicacheCode' => $this->zumhiCode,
            'currentZumhicacheName' => $this->zumhicache ? $this->zumhicache->name : null,
            'isMissing'             => $this->isMissing,
            'trackingNumber'        => $this->trackingNumber,
            'kilometersTraveled'    => $this->kilometersTraveled,
            'milesTraveled'         => $this->milesTraveled,
            'trackableType'         => $trackableType,
            'url'                   => $this->url,
            'owner'                 => $owner,
            'holder'                => $holder,
        ];
    }
}
