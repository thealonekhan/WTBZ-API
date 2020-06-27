<?php

namespace App\Http\Responses\Backend\ZumhicacheAttributes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheAttributes\ZumhiCacheAttribute
     */
    protected $zumhicacheattributes;

    /**
     * @param App\Models\ZumhicacheAttributes\ZumhiCacheAttribute $zumhicacheattributes
     */
    public function __construct($zumhicacheattributes)
    {
        $this->zumhicacheattributes = $zumhicacheattributes;
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
        return view('backend.zumhicacheattributes.edit')->with([
            'zumhicacheattributes' => $this->zumhicacheattributes
        ]);
    }
}