<?php

namespace App\Http\Responses\Backend\Sponsor;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\Sponsor\Sponsor
     */
    protected $sponsor;

    /**
     * @param \App\Models\Sponsor\Sponsor $sponsor
     */
    public function __construct($sponsor)
    {
        $this->sponsor = $sponsor;
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
        return view('backend.sponsors.show')->with([
            'sponsor' => $this->sponsor
        ]);
    }
}
