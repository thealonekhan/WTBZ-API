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
            'user_id'               => $this->owner()->username,
            'membership_id'         => $this->membership()->name,
            'joinedDateUtc'         => $this->joinedDateUtc->format('d/m/Y h:i A'),
            'avatarUrl'             => $this->avatarUrl,
            'bannerUrl'             => $this->bannerUrl,
            'url'                   => $this->url,
            'profileText'           => $this->profileText,
            'coordinates_id'        => $this->coordinate()->latitude.' '.$this->coordinate()->longitude,
            'isFriend'              => $this->isFriend,
            'optedInFriendSharing'  => $this->optedInFriendSharing,
            'created_at'            => $this->created_at->toIso8601String(),
            'updated_at'            => $this->updated_at->toIso8601String(),
        ];
    }
}
