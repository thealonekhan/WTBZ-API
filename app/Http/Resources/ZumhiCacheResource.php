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
        return [
            'referenceCode'         => $this->referenceCode,
            'name'                  => $this->name,
            'difficulty'            => $this->difficulty,
            'terrain'               => $this->terrain,
            'placedDate'            => $this->placedDate->format('d/m/Y h:i A'),
            'publishedDate'         => $this->publishedDate->format('d/m/Y h:i A'),
            'eventEndDate'          => $this->eventEndDate->format('d/m/Y h:i A'),
            'user_id'               => $this->owner()->referenceCode,
            'type_id'               => $this->type()->name,
            'size_id'               => $this->size()->name,
            'country_id'            => $this->country()->name,
            'state_id'              => $this->state()->name,
            'coordinates_id'        => $this->coordinate()->latitude.' '.$this->coordinate()->longitude,
            'shortDescription'      => $this->shortDescription,
            'longDescription'       => $this->longDescription,
            'hints'                 => $this->hints,
            'ianaTimezoneId'        => $this->ianaTimezoneId,
            'relatedWebPage'        => $this->relatedWebPage,
            'url'                   => $this->url,
            'containsHtml'          => $this->containsHtml,
            'hasSolutionChecker'    => $this->hasSolutionChecker,
            'status_id'             => $this->status()->name,
            'created_at'            => $this->created_at->toIso8601String(),
            'updated_at'            => $this->updated_at->toIso8601String(),
        ];
    }
}
