<?php

namespace App\Http\Responses\Backend\ZCList;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZCList\ZCList
     */
    protected $zclists;

    /**
     * @param App\Models\ZCList\ZCList $zclists
     */
    public function __construct($zclists)
    {
        $this->zclists = $zclists;
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
        return view('backend.zclists.edit')->with([
            'zclists' => $this->zclists
        ]);
    }
}