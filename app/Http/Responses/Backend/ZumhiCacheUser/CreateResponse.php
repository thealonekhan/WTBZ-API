<?php

namespace App\Http\Responses\Backend\ZumhicacheUser;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $users;

    protected $memberships;

    protected $coordinates;


    public function __construct($users, $memberships, $coordinates)
    {
        $this->users = $users;
        $this->memberships = $memberships;
        $this->coordinates = $coordinates;
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
        return view('backend.zumhicacheusers.create')->with([
            'users' => $this->users,
            'memberships' => $this->memberships,
            'coordinates' => $this->coordinates
        ]);
    }
}