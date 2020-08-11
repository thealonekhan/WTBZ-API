<?php

namespace App\Http\Responses\Backend\Trackable;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $countries;

    protected $types;

    protected $ownerCodes;

    protected $zumhiCodes;


    public function __construct($countries, $types, $ownerCodes, $zumhiCodes)
    {
        $this->countries = $countries;
        $this->types = $types;
        $this->ownerCodes = $ownerCodes;
        $this->zumhiCodes = $zumhiCodes;
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
        return view('backend.trackables.create')->with([
            'countries' => $this->countries,
            'types' => $this->types,
            'ownerCodes' => $this->ownerCodes,
            'zumhiCodes' => $this->zumhiCodes
        ]);
    }
}