<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ZumhiCacheResource extends Resource
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
        $attributes = [];
        if (!empty($this->attributes)) {
            foreach ($this->attributes as $value) {
                $attributes[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'isOn' => $value->isOn,
                    'imageUrl' => $value->imageUrl,
                ];
            }
        }
        return [
            'referenceCode'         => $this->referenceCode,
            'name'                  => $this->name,
            'difficulty'            => $this->difficulty,
            'terrain'               => $this->terrain,
            'placedDate'            => $this->placedDate,
            'publishedDate'         => $this->publishedDate,
            'eventEndDate'          => $this->eventEndDate,
            'lastVisitedDate'       => $this->lastVisitedDate,
            'shortDescription'      => $this->shortDescription,
            'longDescription'       => $this->longDescription,
            'hints'                 => $this->hints,
            'ianaTimezoneId'        => $this->ianaTimezoneId,
            'relatedWebPage'        => $this->relatedWebPage,
            'url'                   => $this->url,
            'isPremiumOnly'          => $this->isPremiumOnly,
            'containsHtml'          => $this->containsHtml,
            'hasSolutionChecker'    => $this->hasSolutionChecker,
            'status'                => $this->status->name,
            'owner'                 => [
                'referenceCode'     => $this->owner->referenceCode,
                'username'          => $this->owner->owner->username,
                'membershipLevelId' => $this->owner->membership->id,
                'avatarUrl'         => $this->owner->avatarUrl,
                'profileText'       => $this->owner->profileText,
            ],
            'zumhicacheType'        => [
                'id'                => $this->type->id,
                'name'              => $this->type->name,
                'imageUrl'          => $this->type->imageUrl

            ],
            'zumhicacheSize'        => [
                'id'                => $this->size->id,
                'name'              => $this->size->name,
            ],
            'location'              => [
                'country'           => $this->country->name,
                'country_id'        => $this->country->id,
                'state'             => $this->state->name,
                'state_id'          => $this->state->id,
            ],
            'postedCoordinates'     => [
                'latitude' => $this->coordinate->latitude,
                'longitude' => $this->coordinate->longitude,
            ],
            'attributes'   => $attributes,
            'additionalWaypoints'   => []
        ];
    }
}
