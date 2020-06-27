<?php

namespace App\Http\Responses\Backend\ZumhicacheCoordinates;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate
     */
    protected $zumhicachecoordinates;

    /**
     * @param App\Models\ZumhicacheCoordinates\ZumhiCacheCoordinate $zumhicachecoordinates
     */
    public function __construct($zumhicachecoordinates)
    {
        $this->zumhicachecoordinates = $zumhicachecoordinates;
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
            'zumhicachecoordinates' => $this->zumhicachecoordinates
        ]);
    }
}