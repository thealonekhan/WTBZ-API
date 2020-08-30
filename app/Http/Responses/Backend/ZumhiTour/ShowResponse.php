<?php

namespace App\Http\Responses\Backend\ZumhiTour;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZumhiTour\ZumhiTour
     */
    protected $zumhitour;

    /**
     * @param \App\Models\ZumhiTour\ZumhiTour $zumhitour
     */
    public function __construct($zumhitour)
    {
        $this->zumhitour = $zumhitour;
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
        $sponsor = $this->zumhitour->sponsor->name;
        $coordinates = $this->zumhitour->coordinates->getFullNameAttribute();
        $zumhicaches = $this->zumhitour->zumhicaches;
        return view('backend.zumhitours.show')->with([
            'zumhitour'     => $this->zumhitour,
            'sponsor'       => $sponsor,
            'coordinates'   => $coordinates,
            'zumhicaches'   => $zumhicaches,
        ]);
    }
}
