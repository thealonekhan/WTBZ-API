<?php

namespace App\Http\Responses\Backend\ListZumhiCache;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ListZumhiCache\ListZumhiCache
     */
    protected $listzumhicaches;

    /**
     * @param App\Models\ListZumhiCache\ListZumhiCache $listzumhicaches
     */
    public function __construct($listzumhicaches)
    {
        $this->listzumhicaches = $listzumhicaches;
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
        return view('backend.listzumhicaches.edit')->with([
            'listzumhicaches' => $this->listzumhicaches
        ]);
    }
}