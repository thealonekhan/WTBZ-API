<?php

namespace App\Http\Responses\Backend\ZumhiCacheUser;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZumhicacheUsers\ZumhiCacheUser
     */
    protected $zumhicacheuser;

    /**
     * @param \App\Models\ZumhicacheUsers\ZumhiCacheUser $zumhicacheuser
     */
    public function __construct($zumhicacheuser)
    {
        $this->zumhicacheuser = $zumhicacheuser;
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
        $user = $this->zumhicacheuser->owner->email;
        $membership = $this->zumhicacheuser->membership->name;
        $coordinates = $this->zumhicacheuser->coordinate->getFullNameAttribute();
        return view('backend.zumhicacheusers.show')->with([
            'zumhicacheuser' => $this->zumhicacheuser,
            'membership'       => $membership,
            'coordinates' => $coordinates,
            'user'       => $user,
        ]);
    }
}
