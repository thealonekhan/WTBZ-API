<?php

namespace App\Http\Responses\Backend\ZumhicacheAttributetypes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    
    /**
     * @var App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType
     */
    protected $zumhicacheattributetype;
    protected $attributes;

    /**
     * @param App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeType $zumhicacheattributetypes
     */
    public function __construct($zumhicacheattributetype, $attributes)
    {
        $this->zumhicacheattributetype = $zumhicacheattributetype;
        $this->attributes = $attributes;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.zumhicacheattributetypes.edit')->with([
            'zumhicacheattributetype' => $this->zumhicacheattributetype,
            'attributes' => $this->attributes
        ]);
    }
}