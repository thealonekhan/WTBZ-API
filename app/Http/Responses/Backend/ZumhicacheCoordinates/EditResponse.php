<?php

namespace App\Http\Responses\Backend\ZumhicacheCoordinates;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate
     */
    protected $zumhicachecoordinate;

    /**
     * @param App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate $zumhicachecoordinate
     */
    public function __construct($zumhicachecoordinate)
    {
        $this->zumhicachecoordinate = $zumhicachecoordinate;
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
        return view('backend.zumhicachecoordinates.edit')->with([
            'zumhicachecoordinate' => $this->zumhicachecoordinate
        ]);
    }
}