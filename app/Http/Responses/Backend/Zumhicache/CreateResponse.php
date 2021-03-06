<?php

namespace App\Http\Responses\Backend\Zumhicache;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $users;

    protected $types;

    protected $sizes;

    protected $coordinates;
    
    protected $attributes;

    protected $countries;

    protected $statuses;

    protected $timezoneids;

    public function __construct($users, $types, $sizes, $coordinates, $attributes, $countries, $statuses, $timezoneids)
    {
        $this->users = $users;
        $this->types = $types;
        $this->sizes = $sizes;
        $this->coordinates = $coordinates;
        $this->attributes = $attributes;
        $this->countries = $countries;
        $this->statuses = $statuses;
        $this->timezoneids = $timezoneids;
    }

    public function toResponse($request)
    {
        return view('backend.zumhicaches.create')->with([
            'users' => $this->users,
            'types' => $this->types,
            'sizes' => $this->sizes,
            'coordinates' => $this->coordinates,
            'attributes' => $this->attributes,
            'countries' => $this->countries,
            'statuses' => $this->statuses,
            'timezoneids' => $this->timezoneids,
        ]);
    }
}