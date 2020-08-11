<?php

namespace App\Http\Responses\Backend\TrackableLogType;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\TrackableLogType\TrackableLogType
     */
    protected $trackablelogtypes;

    /**
     * @param App\Models\TrackableLogType\TrackableLogType $trackablelogtypes
     */
    public function __construct($trackablelogtypes)
    {
        $this->trackablelogtypes = $trackablelogtypes;
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
        return view('backend.trackablelogtypes.edit')->with([
            'trackablelogtypes' => $this->trackablelogtypes
        ]);
    }
}