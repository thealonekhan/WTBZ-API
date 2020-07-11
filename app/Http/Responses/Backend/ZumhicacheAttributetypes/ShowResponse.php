<?php

namespace App\Http\Responses\Backend\ZumhicacheAttributetypes;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZumhicacheAttributes\ZumhiCacheAttributes
     */
    protected $zumhicacheattributetype;

    /**
     * @param \App\Models\ZumhicacheAttributetypes\ZumhiCacheAttributeTypes $zumhicacheattributetype
     */
    public function __construct($zumhicacheattributetype)
    {
        $this->zumhicacheattributetype = $zumhicacheattributetype;
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
        $attribute = $this->zumhicacheattributetype->attribute->name;
        return view('backend.zumhicacheattributetypes.show')->with([
            'zumhicacheattributetype' => $this->zumhicacheattributetype,
            'attribute' => $attribute
        ]);
    }
}
