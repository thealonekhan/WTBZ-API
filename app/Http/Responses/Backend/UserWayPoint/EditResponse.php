<?php

namespace App\Http\Responses\Backend\UserWayPoint;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\UserWayPoint\UserWayPoint
     */
    protected $userwaypoints;

    /**
     * @param App\Models\UserWayPoint\UserWayPoint $userwaypoints
     */
    public function __construct($userwaypoints)
    {
        $this->userwaypoints = $userwaypoints;
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
        return view('backend.userwaypoints.edit')->with([
            'userwaypoints' => $this->userwaypoints
        ]);
    }
}