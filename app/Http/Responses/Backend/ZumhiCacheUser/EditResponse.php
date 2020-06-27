<?php

namespace App\Http\Responses\Backend\ZumhicacheUser;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\ZumhicacheUser\ZumhiCacheUser
     */
    protected $zumhicacheuser;

    protected $users;

    protected $memberships;

    protected $coordinates;

    /**
     * @param App\Models\ZumhicacheUser\ZumhiCacheUser $zumhicacheuser
     */
    public function __construct($zumhicacheuser, $users, $memberships, $coordinates)
    {
        $this->zumhicacheuser = $zumhicacheuser;
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
        return view('backend.zumhicacheusers.edit')->with([
            'zumhicacheuser' => $this->zumhicacheuser,
            'users' => $this->users,
            'memberships' => $this->memberships,
            'coordinates' => $this->coordinates,
        ]);
    }
}