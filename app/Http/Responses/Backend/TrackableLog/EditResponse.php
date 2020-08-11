<?php

namespace App\Http\Responses\Backend\TrackableLog;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\TrackableLog\TrackableLog
     */
    protected $trackablelogs;

    /**
     * @param App\Models\TrackableLog\TrackableLog $trackablelogs
     */
    public function __construct($trackablelogs)
    {
        $this->trackablelogs = $trackablelogs;
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
        return view('backend.trackablelogs.edit')->with([
            'trackablelogs' => $this->trackablelogs
        ]);
    }
}