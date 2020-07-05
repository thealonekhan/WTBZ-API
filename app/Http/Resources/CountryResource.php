<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'code'              => $this->code,
            'name'              => $this->name,
            'states'            => $this->states
            // 'created_at'        => optional($this->created_at)->toDateString(),
            // 'updated_at'        => optional($this->updated_at)->toDateString(),
        ];
    }
}
