<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ZumhiTourResource extends Resource
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
            'name'                  => $this->name,
            'description'           => $this->description,
            'longDescription'       => $this->longDescription,
            'postedCoordinates'     => [
                'latitude'          => $this->coordinates->latitude,
                'longitude'         => $this->coordinates->longitude,
            ],
            'zumhicacheCount'       => count($this->zumhicaches),
            'url'                   => $this->url,
            'coverImageUrl'         => $this->coverImageUrl,
            'logoImageUrl'          => $this->logoImageUrl,
            'favoritePoints'        => 0,
            'sponsor'               => [
                'name'                  => $this->sponsor->name,
                'relatedWebPage'        => $this->sponsor->relatedWebPage,
                'relatedWebPageText'    => $this->sponsor->relatedWebPageText,
            ],
        ];
    }
}
