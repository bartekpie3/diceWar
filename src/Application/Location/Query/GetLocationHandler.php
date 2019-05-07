<?php

namespace App\Application\Location\Query;

class GetLocationHandler
{


    /**
     * @param getLocationQuery $query
     *
     * @return LocationView
     */
    public function handle(getLocationQuery $query): LocationView
    {
        return new LocationView();
    }
}
