<?php

namespace App\Http\Responses\Backend\ZumhicacheAttributes;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZumhicacheAttributes\ZumhiCacheAttributes
     */
    protected $zumhicacheattribute;

    /**
     * @param \App\Models\ZumhicacheAttributes\ZumhiCacheAttributes $zumhicacheattribute
     */
    public function __construct($zumhicacheattribute)
    {
        $this->zumhicacheattribute = $zumhicacheattribute;
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
        return view('backend.zumhicacheattributes.show')->with([
            'zumhicacheattribute' => $this->zumhicacheattribute
        ]);
    }
}
