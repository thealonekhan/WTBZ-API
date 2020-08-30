<?php

namespace App\Http\Responses\Backend\ZumhiTour;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhiTour\ZumhiTour
     */
    protected $zumhitour;

    protected $coordinates;

    protected $zumhicaches;

    protected $sponsors;

    /**
     * @param App\Models\ZumhiTour\ZumhiTour $zumhitour
     */
    public function __construct($zumhitour, $coordinates, $zumhicaches, $sponsors)
    {
        $this->zumhitour = $zumhitour;
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

        $selectedZumhicaches = $this->zumhitour->zumhicaches->pluck('id')->toArray();
        return view('backend.zumhitours.edit')->with([
            'zumhitour' => $this->zumhitour,
            'coordinates' => $this->coordinates,
            'zumhicaches' => $this->zumhicaches,
            'selectedZumhicaches' => $selectedZumhicaches,
            'sponsors' => $this->sponsors,
        ]);
    }
}