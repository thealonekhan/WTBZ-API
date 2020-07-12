<?php

namespace App\Http\Responses\Backend\LogType;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\LogType\LogType
     */
    protected $logtypes;

    /**
     * @param App\Models\LogType\LogType $logtypes
     */
    public function __construct($logtypes)
    {
        $this->logtypes = $logtypes;
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
        return view('backend.logtypes.edit')->with([
            'logtypes' => $this->logtypes
        ]);
    }
}