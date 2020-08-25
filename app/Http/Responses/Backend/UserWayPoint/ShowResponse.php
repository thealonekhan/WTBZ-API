<?php

namespace App\Http\Responses\Backend\UserWayPoint;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\UserWayPoint\UserWayPoint
     */
    protected $userwaypoint;

    /**
     * @param \App\Models\UserWayPoint\UserWayPoint $userwaypoint
     */
    public function __construct($userwaypoint)
    {
        $this->userwaypoint = $userwaypoint;
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
        $coordinates = $this->userwaypoint->coordinate ? $this->userwaypoint->coordinate->getFullNameAttribute() : '';
        return view('backend.userwaypoints.show')->with([
            'userwaypoint' => $this->userwaypoint,
            'coordinates' => $coordinates,
        ]);
    }
}
