<?php

namespace App\Http\Responses\Backend\ZCList;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var \App\Models\ZCList\ZCList
     */
    protected $zclist;

    /**
     * @param \App\Models\ZCList\ZCList $zclist
     */
    public function __construct($zclist)
    {
        $this->zclist = $zclist;
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
        $listtype = $this->zclist->listtype ? $this->zclist->listtype->name : '';
        return view('backend.zclists.show')->with([
            'zclist' => $this->zclist,
            'listtype' => $listtype,
        ]);
    }
}
