<?php

namespace App\Http\Responses\Backend\ZumhicacheAttributetypes;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $attributes;

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
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
        return view('backend.zumhicacheattributetypes.create')->with([
            'attributes' => $this->attributes,
        ]);;
    }
}