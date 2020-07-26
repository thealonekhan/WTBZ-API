<?php

namespace App\Http\Responses\Backend\ZumhicacheCoordinates;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinates
     */
    protected $zumhicachecoordinate;

    /**
     * @param \App\Models\ZumhiCacheCoordinates\ZumhiCacheCoordinates $zumhicachecoordinate
     */
    public function __construct($zumhicachecoordinate)
    {
        $this->zumhicachecoordinate = $zumhicachecoordinate;
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
        return view('backend.zumhicachecoordinates.show')->with([
            'zumhicachecoordinate' => $this->zumhicachecoordinate
        ]);
    }
}
