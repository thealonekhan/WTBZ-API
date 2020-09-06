<?php

namespace App\Http\Responses\Backend\ListType;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ListType\ListType
     */
    protected $listtypes;

    /**
     * @param App\Models\ListType\ListType $listtypes
     */
    public function __construct($listtypes)
    {
        $this->listtypes = $listtypes;
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
        return view('backend.listtypes.edit')->with([
            'listtypes' => $this->listtypes
        ]);
    }
}