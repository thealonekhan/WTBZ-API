<?php

namespace App\Http\Responses\Backend\ZumhiCache;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\Zumhicaches\ZumhiCache
     */
    protected $zumhicache;

    /**
     * @param \App\Models\Zumhicaches\ZumhiCache $zumhicache
     */
    public function __construct($zumhicache)
    {
        $this->zumhicache = $zumhicache;
    }

    /**
     * In Response.
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        $user = $this->zumhicache->owner->referenceCode . ' '. $this->zumhicache->owner->owner->username;
        $type = $this->zumhicache->type->name;
        $size = $this->zumhicache->size->name;
        $country = $this->zumhicache->country->name;
        $state = $this->zumhicache->state->name;
        $status = $this->zumhicache->status->name;
        $coordinates = $this->zumhicache->coordinate->getFullNameAttribute();
        $attributes = $this->zumhicache->attributes;
        return view('backend.zumhicaches.show')->with([
            'zumhicache' => $this->zumhicache,
            'type'       => $type,
            'size'       => $size,
            'country'    => $country,
            'state'      => $state,
            'status'     => $status,
            'coordinates' => $coordinates,
            'attributes' => $attributes,
            'user'       => $user,
        ]);
    }
}
