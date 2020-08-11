<?php

namespace App\Http\Responses\Backend\TrackableLog;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\TrackableLog\TrackableLog
     */
    protected $trackablelog;

    /**
     * @param \App\Models\TrackableLog\TrackableLog $trackablelog
     */
    public function __construct($trackablelog)
    {
        $this->trackablelog = $trackablelog;
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
        $zumhicacheName = $this->trackablelog->zumhicache->name;
        $trackableLogType = $this->trackablelog->trackableLogType->name;
        $coordinates = $this->trackablelog->coordinate ? $this->trackablelog->coordinate->getFullNameAttribute() : '';
        return view('backend.trackablelogs.show')->with([
            'trackablelog' => $this->trackablelog,
            'zumhicacheName' => $zumhicacheName,
            'trackableLogType' => $trackableLogType,
            'coordinates' => $coordinates,
        ]);
    }
}
