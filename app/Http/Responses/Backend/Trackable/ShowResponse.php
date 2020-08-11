<?php

namespace App\Http\Responses\Backend\Trackable;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\Trackable\Trackable
     */
    protected $trackable;

    /**
     * @param \App\Models\Trackable\Trackable $trackable
     */
    public function __construct($trackable)
    {
        $this->trackable = $trackable;
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
        $originCountry = $this->trackable->country->name;
        $currentZumhicacheName = $this->trackable->zumhicache->name;
        $trackableType = $this->trackable->type->name;
        return view('backend.trackables.show')->with([
            'trackable' => $this->trackable,
            'originCountry' => $originCountry,
            'currentZumhicacheName' => $currentZumhicacheName,
            'trackableType' => $trackableType,
        ]);
    }
}
