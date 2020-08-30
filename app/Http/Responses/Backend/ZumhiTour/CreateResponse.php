<?php

namespace App\Http\Responses\Backend\ZumhiTour;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $coordinates;

    protected $zumhicaches;

    protected $sponsors;

    public function __construct($coordinates, $zumhicaches, $sponsors)
    {
        $this->coordinates = $coordinates;
        $this->zumhicaches = $zumhicaches;
        $this->sponsors = $sponsors;
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
        return view('backend.zumhitours.create')->with([
            'coordinates' => $this->coordinates,
            'zumhicaches' => $this->zumhicaches,
            'sponsors' => $this->sponsors,
        ]);
    }
}