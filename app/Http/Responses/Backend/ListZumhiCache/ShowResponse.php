<?php

namespace App\Http\Responses\Backend\ListZumhiCache;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ListZumhiCache\ListZumhiCache
     */
    protected $listzumhicache;

    /**
     * @param \App\Models\ListZumhiCache\ListZumhiCache $listzumhicache
     */
    public function __construct($listzumhicache)
    {
        $this->listzumhicache = $listzumhicache;
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
        $zumhicacheName = $this->listzumhicache->zumhicache ? $this->listzumhicache->zumhicache->name : '';
        $listName = $this->listzumhicache->ZCList ? $this->listzumhicache->ZCList->name : '';
        return view('backend.listzumhicaches.show')->with([
            'listzumhicache' => $this->listzumhicache,
            'zumhicacheName' => $zumhicacheName,
            'listName' => $listName,
        ]);
    }
}
