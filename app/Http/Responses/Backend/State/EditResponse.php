<?php

namespace App\Http\Responses\Backend\State;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\State\State
     */
    protected $states;

    /**
     * @param App\Models\State\State $states
     */
    public function __construct($states)
    {
        $this->states = $states;
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
        return view('backend.states.edit')->with([
            'states' => $this->states
        ]);
    }
}