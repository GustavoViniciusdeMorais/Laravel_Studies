<?php

namespace GustavoMorais\Sale\Facades;

use Illuminate\Support\Facades\Facade;

class SaleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sale';
    }
}
