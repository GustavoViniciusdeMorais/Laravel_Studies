<?php

namespace Redninjaturtle\RedLaravelLocation;

class Location
{

    private $locale = 'en';

    public function __construct($locale = 'en')
    {
        $this->locale = $locale;
    }

    public function getLocation()
    {
        return $this->locale;
    }
}
