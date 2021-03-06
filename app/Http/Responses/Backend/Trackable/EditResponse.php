<?php

namespace App\Http\Responses\Backend\Trackable;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Trackable\Trackable
     */
    protected $trackable;

    protected $countries;

    protected $types;

    protected $ownerCodes;

    protected $zumhiCodes;

    /**
     * @param App\Models\Trackable\Trackable $trackable
     */
    public function __construct($trackable, $countries, $types, $ownerCodes, $zumhiCodes)
    {
        $this->trackable = $trackable;
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
        return view('backend.trackables.edit')->with([
            'trackable' => $this->trackable,
            'countries' => $this->countries,
            'types' => $this->types,
            'ownerCodes' => $this->ownerCodes,
            'zumhiCodes' => $this->zumhiCodes
        ]);
    }
}