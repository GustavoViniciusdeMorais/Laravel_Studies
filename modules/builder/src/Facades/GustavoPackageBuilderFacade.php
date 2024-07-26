<?php

namespace Modules\Builder\Facades;

use Illuminate\Support\Facades\Facade;

class GustavoPackageBuilderFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'builder';
    }
}
