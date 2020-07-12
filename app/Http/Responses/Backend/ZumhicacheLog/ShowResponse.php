<?php

namespace App\Http\Responses\Backend\ZumhiCacheLog;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZumhicacheLog\ZumhiCacheLog
     */
    protected $zumhicachelog;

    /**
     * @param \App\Models\ZumhiCacheLog\ZumhiCacheLog $zumhicachelog
     */
    public function __construct($zumhicachelog)
    {
        $this->zumhicachelog = $zumhicachelog;
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
        $ownerCode = $this->zumhicachelog->owner->referenceCode;
        $zumhicacheCode = $this->zumhicachelog->zumhicache->referenceCode;
        $zumhicacheName = $this->zumhicachelog->zumhicache->Name;
        $logType = $this->zumhicacheuser->logType->name;
        $coordinates = $this->zumhicacheuser->coordinate->getFullNameAttribute();
        return view('backend.zumhicacheusers.show')->with([
            'zumhicachelog' => $this->zumhicachelog,
            'ownerCode' => $ownerCode,
            'zumhicacheCode' => $zumhicacheCode,
            'zumhicacheName' => $zumhicacheName,
            'logType' => $logType,
            'coordinates' => $coordinates,
        ]);
    }
}
