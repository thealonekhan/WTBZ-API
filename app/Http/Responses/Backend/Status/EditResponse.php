<?php

namespace App\Http\Responses\Backend\Status;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Status\Status
     */
    protected $statuses;

    /**
     * @param App\Models\Status\Status $statuses
     */
    public function __construct($statuses)
    {
        $this->statuses = $statuses;
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
        return view('backend.statuses.edit')->with([
            'statuses' => $this->statuses
        ]);
    }
}