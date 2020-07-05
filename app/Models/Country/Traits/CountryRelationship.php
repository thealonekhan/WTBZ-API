<?php

namespace App\Models\Country\Traits;

use App\Models\State\State;

/**
 * Class CountryRelationship
 */
trait CountryRelationship
{
    /*
    * put you model relationships here
    * Take below example for reference
    */
    public function states() {
        return $this->hasMany(State::class)->select('id', 'name');
    }
    
}
