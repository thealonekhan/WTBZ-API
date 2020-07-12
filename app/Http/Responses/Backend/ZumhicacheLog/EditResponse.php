<?php

namespace App\Http\Responses\Backend\ZumhicacheLog;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheLog\ZumhiCacheLog
     */
    protected $zumhicachelogs;

    /**
     * @param App\Models\ZumhicacheLog\ZumhiCacheLog $zumhicachelogs
     */
    public function __construct($zumhicachelogs)
    {
        $this->zumhicachelogs = $zumhicachelogs;
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
        return view('backend.zumhicachelogs.edit')->with([
            'zumhicachelogs' => $this->zumhicachelogs
        ]);
    }
}