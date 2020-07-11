<?php

namespace App\Http\Responses\Backend\Zumhicache;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Zumhicache\ZumhiCache
     */
    protected $zumhicache;

    protected $users;

    protected $types;

    protected $sizes;

    protected $coordinates;
    
    protected $attributes;

    protected $countries;

    protected $selectedStates;

    protected $statuses;

    protected $timezoneids;

    /**
     * @param App\Models\Zumhicache\ZumhiCache $zumhicache
     */
    public function __construct($zumhicache, $users, $types, $sizes, $coordinates, $attributes, $countries, $selectedStates, $statuses, $timezoneids)
    {
        $this->zumhicache = $zumhicache;
        $this->users = $users;
        $this->types = $types;
        $this->sizes = $sizes;
        $this->coordinates = $coordinates;
        $this->attributes = $attributes;
        $this->countries = $countries;
        $this->selectedStates = $selectedStates;
        $this->statuses = $statuses;
        $this->timezoneids = $timezoneids;
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
        $selectedAttributes = $this->zumhicache->attributes->pluck('id')->toArray();
        return view('backend.zumhicaches.edit')->with([
            'zumhicache' => $this->zumhicache,
            'users' => $this->users,
            'types' => $this->types,
            'sizes' => $this->sizes,
            'coordinates' => $this->coordinates,
            'attributes' => $this->attributes,
            'selectedAttributes' => $selectedAttributes,
            'countries' => $this->countries,
            'selectedStates' => $this->selectedStates,
            'statuses' => $this->statuses,
            'timezoneids' => $this->timezoneids,
        ]);
    }
}