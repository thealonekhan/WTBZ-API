<?php

namespace App\Http\Responses\Backend\ZumhicacheTypes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheTypes\ZumhiCacheType
     */
    protected $zumhicachetypes;

    /**
     * @param App\Models\ZumhicacheTypes\ZumhiCacheType $zumhicachetypes
     */
    public function __construct($zumhicachetypes)
    {
        $this->zumhicachetypes = $zumhicachetypes;
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
        return view('backend.zumhicachetypes.edit')->with([
            'zumhicachetypes' => $this->zumhicachetypes
        ]);
    }
}