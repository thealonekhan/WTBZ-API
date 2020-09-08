<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ZumhiCacheUserResource extends Resource
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
            'findCount'             => 0,
            'hideCount'             => 0,
            'favoritePoints'        => 0,
            'username'              => $this->owner->username ? $this->owner->username : $this->owner->email,
            'membershipLevelId'     => $this->membership->id,
            'joinedDateUtc'         => $this->joinedDateUtc,
            'avatarUrl'             => $this->avatarUrl,
            'bannerUrl'             => $this->bannerUrl,
            'url'                   => $this->url,
            'profileText'           => $this->profileText,
            'homeCoordinates'       => [
                'latitude'          => $this->coordinate->latitude,
                'longitude'         => $this->coordinate->longitude,
            ],
            'isFriend'              => $this->isFriend,
            'souvenirCount'         => 0,
            'awardedFavoritePoints' => 0,
            'optedInFriendSharing'  => 0,
            'created_at'            => $this->created_at->toIso8601String(),
            'updated_at'            => $this->updated_at->toIso8601String(),
        ];
    }
}
