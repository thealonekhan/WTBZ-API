<?php

namespace App\Http\Responses\Backend\ZumhicacheMemberships;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheMemberships\ZumhiCacheMembership
     */
    protected $zumhicachememberships;

    /**
     * @param App\Models\ZumhicacheMemberships\ZumhiCacheMembership $zumhicachememberships
     */
    public function __construct($zumhicachememberships)
    {
        $this->zumhicachememberships = $zumhicachememberships;
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
        return view('backend.zumhicachememberships.edit')->with([
            'zumhicachememberships' => $this->zumhicachememberships
        ]);
    }
}