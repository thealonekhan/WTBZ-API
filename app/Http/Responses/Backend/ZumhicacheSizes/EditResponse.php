<?php

namespace App\Http\Responses\Backend\ZumhicacheSizes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheSizes\ZumhiCacheSize
     */
    protected $zumhicachesizes;

    /**
     * @param App\Models\ZumhicacheSizes\ZumhiCacheSize $zumhicachesizes
     */
    public function __construct($zumhicachesizes)
    {
        $this->zumhicachesizes = $zumhicachesizes;
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
        return view('backend.zumhicachesizes.edit')->with([
            'zumhicachesizes' => $this->zumhicachesizes
        ]);
    }
}