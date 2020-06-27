<?php

namespace App\Http\Responses\Backend\Country;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Country\Country
     */
    protected $countries;

    /**
     * @param App\Models\Country\Country $countries
     */
    public function __construct($countries)
    {
        $this->countries = $countries;
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
        return view('backend.countries.edit')->with([
            'countries' => $this->countries
        ]);
    }
}