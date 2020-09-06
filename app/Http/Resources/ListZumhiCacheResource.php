<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ListZumhiCacheResource extends Resource
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
            'referenceCode'         => $this->zumhiCode,
            'name'                  => $this->zumhicache->name,
        ];
    }
}
